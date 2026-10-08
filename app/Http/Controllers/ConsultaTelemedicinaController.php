<?php

namespace App\Http\Controllers;

use App\Models\ConsultaTelemedicina;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ConsultaTelemedicinaController extends Controller
{
      
    public function index(Request $request)
    {
        $query = ConsultaTelemedicina::with(['paciente', 'medico'])
            ->orderBy('fecha_hora_programada', 'desc');

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('paciente_id')) {
            $query->where('paciente_id', $request->paciente_id);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if ($user->hasRole('medico')) {
            $query->where('medico_id', Auth::id());
        }

        $consultas = $query->paginate(15);
        $pacientes = Paciente::orderBy('nombre')->get();
        $estados = ['programada', 'en_curso', 'completada', 'cancelada'];

        return view('telemedicina.index', compact('consultas', 'pacientes', 'estados'));
    }

    public function create()
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $medicos = User::whereHas('roles', function($q) {
            $q->where('name', 'medico');
        })->orderBy('name')->get();

        return view('telemedicina.create', compact('pacientes', 'medicos'));
    }

    public function store(Request $request)
    {
        $tipoPaciente = $request->get('tipo_paciente', 'existente');
        
        // Validaciones según el tipo de paciente
        $reglas = [
            'medico_id' => 'required|exists:users,id',
            'fecha_hora_programada' => 'required|date',
            'duracion' => 'required|integer|min:15|max:120',
            'motivo' => 'required|string|max:500',
            'notas' => 'nullable|string|max:1000',
            'estado' => 'nullable|in:programada,en_curso',
        ];
        
        if ($tipoPaciente === 'existente') {
            $reglas['paciente_id'] = 'required|exists:pacientes,id';
        } else {
            $reglas['nuevo_paciente.nombre'] = 'required|string|max:255';
            $reglas['nuevo_paciente.apellido'] = 'required|string|max:255';
            $reglas['nuevo_paciente.cedula'] = 'required|string|max:20';
            $reglas['nuevo_paciente.fecha_nacimiento'] = 'required|date';
            $reglas['nuevo_paciente.genero'] = 'required|in:M,F,Otro';
            $reglas['nuevo_paciente.telefono'] = 'nullable|string|max:20';
            $reglas['nuevo_paciente.email'] = 'nullable|email|max:255';
        }
        
        $request->validate($reglas);
        
        DB::beginTransaction();
        try {
            // ===== CREAR O BUSCAR PACIENTE =====
            if ($tipoPaciente === 'nuevo') {
                $datosPaciente = $request->input('nuevo_paciente');
                
                $paciente = Paciente::create([
                    'nombre' => $datosPaciente['nombre'],
                    'apellido' => $datosPaciente['apellido'],
                    'cedula' => $datosPaciente['cedula'],
                    'fecha_nacimiento' => $datosPaciente['fecha_nacimiento'],
                    'genero' => $datosPaciente['genero'],
                    'telefono' => $datosPaciente['telefono'] ?? '',
                    'email' => $datosPaciente['email'] ?? '',
                    'pais' => 'Ecuador',
                    'provincia' => 'Bolívar',
                    'ciudad' => 'Guaranda',
                    'ocupacion' => 'No especificada',
                ]);
            } else {
                $paciente = Paciente::findOrFail($request->paciente_id);
            }
            
            // ===== CREAR SALA (JITSI) =====
            $sala = ConsultaTelemedicina::generarSala();
            $estado = $request->get('estado', 'programada');
            
            $consulta = ConsultaTelemedicina::create([
                'paciente_id' => $paciente->id,
                'medico_id' => $request->medico_id,
                'fecha_hora_programada' => $request->fecha_hora_programada,
                'duracion' => $request->duracion,
                'sala_nombre' => $sala,
                'estado' => $estado,
                'motivo' => $request->motivo,
                'notas' => $request->notas,
            ]);
            
            DB::commit();
            
            // Redirigir según el estado
            if ($estado === 'en_curso') {
                return redirect()->route('telemedicina.sala', $consulta)
                    ->with('success', 'Consulta creada. Entrando a la sala...');
            }
            
            return redirect()->route('telemedicina.show', $consulta)
                ->with('success', 'Consulta de telemedicina creada exitosamente.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Error al crear la consulta: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(ConsultaTelemedicina $consulta)
    {
        $consulta->load(['paciente', 'medico', 'historialClinico']);
        return view('telemedicina.show', compact('consulta'));
    }

    public function edit(ConsultaTelemedicina $consulta)
    {
        $pacientes = Paciente::orderBy('nombre')->get();
        $medicos = User::whereHas('roles', function($q) {
            $q->where('name', 'medico');
        })->orderBy('name')->get();

        return view('telemedicina.edit', compact('consulta', 'pacientes', 'medicos'));
    }

    public function update(Request $request, ConsultaTelemedicina $consulta)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'fecha_hora_programada' => 'required|date',
            'duracion' => 'required|integer|min:15|max:120',
            'estado' => 'required|in:programada,en_curso,completada,cancelada',
            'motivo' => 'required|string|max:500',
            'notas' => 'nullable|string|max:1000',
        ]);

        try {
            $consulta->update($request->all());

            return redirect()->route('telemedicina.show', $consulta)
                ->with('success', 'Consulta actualizada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar la consulta: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(ConsultaTelemedicina $consulta)
    {
        try {
            $consulta->delete();

            return redirect()->route('telemedicina.index')
                ->with('success', 'Consulta eliminada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar la consulta: ' . $e->getMessage());
        }
    }

    public function iniciar(ConsultaTelemedicina $consulta)
{
    try {
        $consulta->update([
            'estado' => 'en_curso',
            'fecha_inicio_real' => now(),
        ]);

        // Redirige a la URL de Jitsi en una nueva pestaña
        return redirect()->away($consulta->enlace_acceso);

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error al iniciar la consulta: ' . $e->getMessage());
    }
}

    public function finalizar(ConsultaTelemedicina $consulta)
    {
        try {
            $consulta->update([
                'estado' => 'completada',
                'fecha_fin_real' => now(),
            ]);

            return redirect()->route('telemedicina.show', $consulta)
                ->with('success', 'Consulta finalizada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al finalizar la consulta: ' . $e->getMessage());
        }
    }

    public function cancelar(ConsultaTelemedicina $consulta)
    {
        try {
            $consulta->update([
                'estado' => 'cancelada',
            ]);

            return redirect()->route('telemedicina.show', $consulta)
                ->with('success', 'Consulta cancelada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al cancelar la consulta: ' . $e->getMessage());
        }
    }

    public function popup(ConsultaTelemedicina $consulta)
    {
        // Verificar que el médico sea el asignado o un admin
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if ($user->id !== $consulta->medico_id && !$user->hasRole('Administrador')) {
            abort(403, 'No tiene permiso para acceder a esta consulta.');
        }
        
        $consulta->load(['paciente', 'medico']);
        
        return view('telemedicina.popup', compact('consulta'));
    }


    /**
     * Sala de videollamada - Vista principal de la consulta
     */
    public function sala(ConsultaTelemedicina $consulta)
{
    // Verificar permisos
    if (auth()->id() !== $consulta->medico_id && !auth()->user()->hasRole('Administrador')) {
        abort(403, 'No tiene permiso para acceder a esta consulta.');
    }

    // Cargar relaciones
    $consulta->load(['paciente', 'medico', 'historialClinico']);

    // Guardar en sesión (por si acaso)
    session(['consulta_activa_id' => $consulta->id]);

    // Cambiar estado a "en_curso" si estaba programada
    if ($consulta->estado === 'programada') {
        $consulta->update([
            'estado' => 'en_curso',
            'fecha_inicio_real' => now(),
        ]);
    }

    return view('telemedicina.sala', compact('consulta'));
}
}