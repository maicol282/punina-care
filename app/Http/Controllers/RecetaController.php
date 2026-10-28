<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use App\Models\Receta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    public function index(HistorialClinico $historial)
    {
        $recetas = $historial->recetas()->latest()->get();
        return view('recetas.index', compact('historial', 'recetas'));
    }

    public function create(HistorialClinico $historial)
    {
        return view('recetas.create', compact('historial'));
    }

    public function store(Request $request, HistorialClinico $historial)
    {
        $validated = $request->validate([
            'fecha_emision' => 'required|date',
            'medicamento' => 'required|string|max:255',
            'presentacion' => 'nullable|string|max:100',
            'concentracion' => 'nullable|string|max:100',
            'dosis' => 'required|string|max:255',
            'frecuencia' => 'required|string|max:255',
            'duracion' => 'required|string|max:255',
            'indicaciones' => 'nullable|string',
            'signos_alarma' => 'nullable|string',
'recomendaciones_no_farmacologicas' => 'nullable|string',
            'advertencias' => 'nullable|string',
        ]);

        $historial->recetas()->create($validated);

        return redirect()->route('recetas.index', $historial)
            ->with('success', 'Receta agregada exitosamente.');
    }

public function edit(Receta $receta)
{
    $receta->load('historialClinico.paciente');
    return view('recetas.edit', compact('receta'));
}

public function update(Request $request, Receta $receta)
{
    $request->validate([
        'receta_medicamentos' => 'required|array',
        'receta_medicamentos.*.medicamento' => 'required|string',
        'receta_medicamentos.*.presentacion' => 'nullable|string',
        'receta_medicamentos.*.concentracion' => 'nullable|string',
        'receta_medicamentos.*.dosis' => 'nullable|string',
        'receta_medicamentos.*.frecuencia' => 'nullable|string',
        'receta_medicamentos.*.duracion' => 'nullable|string',
        'receta_medicamentos.*.indicaciones' => 'nullable|string',
        'receta_fecha_emision' => 'required|date',
        'receta_advertencias' => 'nullable|string',
        'receta_signos_alarma' => 'nullable|string',
        'receta_recomendaciones_no_farmacologicas' => 'nullable|string','receta_medicamentos.*.via' => 'nullable|string|max:50',
        'receta_medicamentos.*.cantidad' => 'nullable|string|max:50',
        'receta_medicamentos.*.advertencias' => 'nullable|string',
    ]);

    try {
        $medicamentosValidos = array_filter($request->receta_medicamentos, function($med) {
            return !empty($med['medicamento']);
        });

        $receta->fecha_emision = $request->receta_fecha_emision;
        $receta->medicamentos_json = json_encode($medicamentosValidos);
        
        // Para compatibilidad con el campo medicamento legacy
        $primerMedicamento = reset($medicamentosValidos);
        $receta->medicamento = $primerMedicamento['medicamento'] ?? null;
        $receta->presentacion = $primerMedicamento['presentacion'] ?? null;
        $receta->concentracion = $primerMedicamento['concentracion'] ?? null;
        $receta->dosis = $primerMedicamento['dosis'] ?? null;
        $receta->frecuencia = $primerMedicamento['frecuencia'] ?? null;
        $receta->duracion = $primerMedicamento['duracion'] ?? null;
        $receta->indicaciones = $primerMedicamento['indicaciones'] ?? null;
        
        $receta->advertencias = $request->receta_advertencias;
        $receta->signos_alarma = $request->receta_signos_alarma;
        $receta->recomendaciones_no_farmacologicas = $request->receta_recomendaciones_no_farmacologicas;
        $receta->save();

        return redirect()->route('historial.show', $receta->historial_clinico_id)
            ->with('success', 'Receta actualizada correctamente.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Error al actualizar la receta: ' . $e->getMessage())
            ->withInput();
    }
}

    public function destroy(Receta $receta)
    {
        $historialId = $receta->historial_clinico_id;
        $receta->delete();

        return redirect()->route('recetas.index', $historialId)
            ->with('success', 'Receta eliminada exitosamente.');
    }

public function imprimir($id, \App\Services\PdfSignerService $signer)
{
    // Cargar la receta con todas las relaciones
    $receta = Receta::with(['historialClinico' => function($query) {
        $query->select('*'); 
    }, 'historialClinico.paciente'])->findOrFail($id);
    
    // Verificar y forzar el CIE-10 si es necesario
    if (!$receta->historialClinico->cie10_definitivo && !$receta->historialClinico->cie10_code) {
        $cie10 = \App\Models\Cie10Code::where('diagnostico', $receta->historialClinico->diagnostico)->first();
        if ($cie10) {
            $receta->historialClinico->cie10_code = $cie10->codigo;
            $receta->historialClinico->save();
        }
    }
    
    // Generar el PDF
    $pdf = Pdf::loadView('recetas.pdf', compact('receta'));
    $pdfContent = $pdf->output();

    // Firmar el PDF
    $pdfContent = $signer->firmar($pdfContent);

    // Devolver el PDF firmado para descarga
    return response($pdfContent, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="receta_' . $receta->id . '_' . now()->format('Ymd_His') . '.pdf"');
}

public function imprimirTodas(HistorialClinico $historial, \App\Services\PdfSignerService $signer)
{
    $recetas = $historial->recetas;
    $historial->load('paciente');
    
    // Generar el PDF
    $pdf = Pdf::loadView('recetas.pdf-todas', compact('historial', 'recetas'));
    $pdfContent = $pdf->output();

    // Firmar el PDF
    $pdfContent = $signer->firmar($pdfContent);

    // Devolver el PDF firmado para descarga
    return response($pdfContent, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="recetas_' . $historial->paciente->nombre_completo . '_' . now()->format('Ymd_His') . '.pdf"');
}
public function todas()
{
    $recetas = Receta::with('historialClinico.paciente')
        ->orderBy('created_at', 'desc')
        ->paginate(15);
    
    return view('recetas.todas', compact('recetas'));
}
    public function enviarPorCorreo(Receta $receta, \App\Services\DocumentoMailerService $mailer)
    {
        $resultado = $mailer->enviar($receta, 'receta', 'recetas.pdf');
        return redirect()->back()->with($resultado['success'] ? 'success' : 'error', $resultado['message']);
    }
}