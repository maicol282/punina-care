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
            "fecha_emision" => "required|date",
            "receta_medicamentos" => "required|array",
            "receta_medicamentos.*.medicamento" => "required|string",
            "receta_medicamentos.*.presentacion" => "nullable|string",
            "receta_medicamentos.*.concentracion" => "nullable|string",
            "receta_medicamentos.*.dosis" => "required|string",
            "receta_medicamentos.*.frecuencia" => "required|string",
            "receta_medicamentos.*.duracion" => "required|string",
            "receta_medicamentos.*.via" => "nullable|string|max:50",
            "receta_medicamentos.*.cantidad" => "nullable|string|max:50",
            "receta_medicamentos.*.indicaciones" => "nullable|string",
            "receta_medicamentos.*.advertencias" => "nullable|string",
            "fecha_emision" => "required|date",
            "receta_advertencias" => "nullable|string",
            "receta_signos_alarma" => "nullable|string",
            "receta_recomendaciones_no_farmacologicas" => "nullable|string",
        ]);

        $medicamentosValidos = array_filter($validated["receta_medicamentos"], function($med) {
            return !empty($med["medicamento"]);
        });

        $validated["medicamentos_json"] = json_encode(array_values($medicamentosValidos));

        $primerMedicamento = reset($medicamentosValidos);
        if ($primerMedicamento) {
            $validated["medicamento"] = $primerMedicamento["medicamento"];
            $validated["concentracion"] = $primerMedicamento["concentracion"] ?? null;
            $validated["dosis"] = $primerMedicamento["dosis"] ?? null;
            $validated["frecuencia"] = $primerMedicamento["frecuencia"] ?? null;
            $validated["duracion"] = $primerMedicamento["duracion"] ?? null;
        }

        unset($validated["receta_medicamentos"]);

        $historial->recetas()->create($validated);

        return redirect()->route("recetas.index", $historial)
            ->with("success", "Receta agregada exitosamente.");
    }

public function edit(Receta $receta)
{
    $receta->load('historialClinico.paciente');
    return view('recetas.edit', compact('receta'));
}

    public function update(Request $request, Receta $receta)
    {
        $validated = $request->validate([
            "fecha_emision" => "required|date",
            "receta_medicamentos" => "required|array",
            "receta_medicamentos.*.medicamento" => "required|string",
            "receta_medicamentos.*.presentacion" => "nullable|string",
            "receta_medicamentos.*.concentracion" => "nullable|string",
            "receta_medicamentos.*.dosis" => "nullable|string",
            "receta_medicamentos.*.frecuencia" => "nullable|string",
            "receta_medicamentos.*.duracion" => "nullable|string",
            "receta_medicamentos.*.via" => "nullable|string|max:50",
            "receta_medicamentos.*.cantidad" => "nullable|string|max:50",
            "receta_medicamentos.*.indicaciones" => "nullable|string",
            "receta_medicamentos.*.advertencias" => "nullable|string",
            "fecha_emision" => "required|date",
            "receta_advertencias" => "nullable|string",
            "receta_signos_alarma" => "nullable|string",
            "receta_recomendaciones_no_farmacologicas" => "nullable|string",
        ]);

        $medicamentosValidos = array_filter($validated["receta_medicamentos"], function($med) {
            return !empty($med["medicamento"]);
        });

        $validated["medicamentos_json"] = json_encode(array_values($medicamentosValidos));

        $primerMedicamento = reset($medicamentosValidos);
        if ($primerMedicamento) {
            $validated["medicamento"] = $primerMedicamento["medicamento"];
            $validated["concentracion"] = $primerMedicamento["concentracion"] ?? null;
            $validated["dosis"] = $primerMedicamento["dosis"] ?? null;
            $validated["frecuencia"] = $primerMedicamento["frecuencia"] ?? null;
            $validated["duracion"] = $primerMedicamento["duracion"] ?? null;
        }

        unset($validated["receta_medicamentos"]);

        $receta->update($validated);

        return redirect()->route("recetas.index", $receta->historialClinico)
            ->with("success", "Receta actualizada exitosamente.");
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