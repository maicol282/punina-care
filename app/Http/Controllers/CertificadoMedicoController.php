<?php

namespace App\Http\Controllers;

use App\Models\CertificadoMedico;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificadoMedicoController extends Controller
{
  

    public function index(Request $request)
    {
        $query = CertificadoMedico::with(['paciente', 'historialClinico'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('paciente_id')) {
            $query->where('paciente_id', $request->paciente_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('paciente', function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido', 'LIKE', "%{$search}%")
                  ->orWhere('cedula', 'LIKE', "%{$search}%");
            });
        }

        $certificados = $query->paginate(15);
        $pacientes = Paciente::orderBy('nombre')->get();
        $estados = ['activo', 'anulado'];

        return view('certificados.index', compact('certificados', 'pacientes', 'estados'));
    }

 public function create(HistorialClinico $historial)
{
    $paciente = $historial->paciente;
    $tiposContingencia = [
        'enfermedad_general' => 'Enfermedad General',
        'maternidad' => 'Maternidad',
        'enfermedad_catastrofica' => 'Enfermedad Catastrófica',
        'accidente_laboral' => 'Presunción de Accidente Laboral',
        'enfermedad_laboral' => 'Presunción de Enfermedad Laboral u Ocupacional'
    ];
    
    // Obtener el médico actual (usuario logueado)
    $medico = Auth::user();
    
    // Si no hay usuario logueado, crear uno por defecto
    if (!$medico) {
        $medico = (object) [
            'name' => 'Médico Responsable',
            'especialidad' => 'Medicina General',
            'cedula' => 'N/E'
        ];
    }
    
        // Obtener diagnósticos del historial con CIE-10
    $diagnosticos = $historial->diagnosticos;
    
    // Formatear diagnósticos para el textarea
    $diagnosticosFormateados = '';
    foreach ($diagnosticos as $diag) {
        $codigo = $diag->cie10_code ?: '';
        $descripcion = $diag->descripcion ?: '';
        $diagnosticosFormateados .= strtoupper($descripcion) . ' ' . $codigo . "\n";
    }
    $diagnosticosFormateados = trim($diagnosticosFormateados);
    
    return view('certificados.create', compact('historial', 'paciente', 'tiposContingencia', 'medico', 'diagnosticosFormateados'));
}

    public function store(Request $request)
    {
        $request->validate([
            'historial_clinico_id' => 'required|exists:historial_clinicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_atencion' => 'required|date',
            'diagnosticos' => 'required|string',
            'tipo_contingencia' => 'required|string',
            'reposo' => 'boolean',
            'reposo_inicio' => 'nullable|date|required_if:reposo,1',
            'reposo_fin' => 'nullable|date|after_or_equal:reposo_inicio|required_if:reposo,1',
            'reposo_dias' => 'nullable|integer|min:1',
            'observaciones' => 'nullable|string',
        ]);

        try {
            $paciente = Paciente::findOrFail($request->paciente_id);
            $medico = Auth::user();

            $certificado = new CertificadoMedico();
            $certificado->historial_clinico_id = $request->historial_clinico_id;
            $certificado->paciente_id = $request->paciente_id;
            
            // Datos del paciente
            $certificado->paciente_nombre = $paciente->nombre . ' ' . $paciente->apellido;
            $certificado->paciente_cedula = $paciente->cedula ?? '';
            $certificado->paciente_direccion = $request->paciente_direccion ?? $paciente->direccion ?? '';
            $certificado->paciente_telefono = $request->paciente_telefono ?? $paciente->telefono ?? '';
            $certificado->paciente_empresa = $request->paciente_empresa;
            $certificado->paciente_puesto = $request->paciente_puesto;
            
            // Datos del certificado
            $certificado->fecha_atencion = $request->fecha_atencion;
            $certificado->diagnosticos = $request->diagnosticos;
            $certificado->tipo_contingencia = $request->tipo_contingencia;
            $certificado->reposo = $request->has('reposo');
            $certificado->reposo_inicio = $request->reposo_inicio;
            $certificado->reposo_fin = $request->reposo_fin;
            $certificado->reposo_dias = $request->reposo_dias;
            $certificado->observaciones = $request->observaciones;
            
            // Datos del médico
            $certificado->medico_nombre = $medico->name ?? 'Médico Responsable';
            $certificado->medico_cedula = $medico->cedula ?? '';
            $certificado->medico_especialidad = $medico->especialidad ?? 'Medicina General';
            
            $certificado->save();

            return redirect()->route('certificados.show', $certificado)
                ->with('success', 'Certificado médico generado exitosamente. Número: ' . $certificado->numero_certificado);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al generar el certificado: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(CertificadoMedico $certificado)
    {
        $certificado->load(['paciente', 'historialClinico']);
        return view('certificados.show', compact('certificado'));
    }

    public function edit(CertificadoMedico $certificado)
    {
        $tiposContingencia = [
            'enfermedad_general' => 'Enfermedad General',
            'maternidad' => 'Maternidad',
            'enfermedad_catastrofica' => 'Enfermedad Catastrófica',
            'accidente_laboral' => 'Presunción de Accidente Laboral',
            'enfermedad_laboral' => 'Presunción de Enfermedad Laboral u Ocupacional'
        ];
        return view('certificados.edit', compact('certificado', 'tiposContingencia'));
    }

    public function update(Request $request, CertificadoMedico $certificado)
    {
        $request->validate([
            'fecha_atencion' => 'required|date',
            'diagnosticos' => 'required|string',
            'tipo_contingencia' => 'required|string',
            'reposo' => 'boolean',
            'reposo_inicio' => 'nullable|date|required_if:reposo,1',
            'reposo_fin' => 'nullable|date|after_or_equal:reposo_inicio|required_if:reposo,1',
            'reposo_dias' => 'nullable|integer|min:1',
            'observaciones' => 'nullable|string',
            'estado' => 'required|in:activo,anulado',
        ]);

        try {
            $certificado->fecha_atencion = $request->fecha_atencion;
            $certificado->diagnosticos = $request->diagnosticos;
            $certificado->tipo_contingencia = $request->tipo_contingencia;
            $certificado->reposo = $request->has('reposo');
            $certificado->reposo_inicio = $request->reposo_inicio;
            $certificado->reposo_fin = $request->reposo_fin;
            $certificado->reposo_dias = $request->reposo_dias;
            $certificado->observaciones = $request->observaciones;
            $certificado->paciente_empresa = $request->paciente_empresa;
            $certificado->paciente_puesto = $request->paciente_puesto;
            $certificado->estado = $request->estado;
            $certificado->save();

            return redirect()->route('certificados.show', $certificado)
                ->with('success', 'Certificado actualizado exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el certificado: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(CertificadoMedico $certificado)
    {
        $certificado->delete();
        return redirect()->route('certificados.index')
            ->with('success', 'Certificado eliminado exitosamente.');
    }

    public function imprimir(CertificadoMedico $certificado)
    {
        $certificado->load(['paciente', 'historialClinico']);
        $pdf = Pdf::loadView('certificados.pdf', compact('certificado'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Certificado_Medico_' . $certificado->numero_certificado . '.pdf');
    }

    public function cambiarEstado(Request $request, CertificadoMedico $certificado)
    {
        $request->validate([
            'estado' => 'required|in:activo,anulado'
        ]);

        $certificado->update(['estado' => $request->estado]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado exitosamente.',
            'estado' => $certificado->estado
        ]);
    }
            public function enviarPorCorreo(CertificadoMedico $certificado, \App\Services\DocumentoMailerService $mailer)
    {
        // El tipo de documento para el correo será 'certificado'
        $resultado = $mailer->enviar($certificado, 'certificado', 'certificados.pdf'); 
        
        return redirect()->back()->with($resultado['success'] ? 'success' : 'error', $resultado['message']);
    }
}