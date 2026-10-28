<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
       public function historialPaciente($id, \App\Services\PdfSignerService $signer)
    {
        $paciente = \App\Models\Paciente::with(['historialClinicos' => function($q) {
            $q->orderBy('fecha_consulta', 'desc');
        }])->findOrFail($id);

        $pdf = Pdf::loadView('reportes.historial-paciente', compact('paciente'));
        $pdfContent = $pdf->output();
        
        // Firmar el PDF
        $pdfContent = $signer->firmar($pdfContent);
        
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="historial_' . $paciente->nombre_completo . '_' . now()->format('Ymd_His') . '.pdf"');
    }

       public function historialUnico($id, \App\Services\PdfSignerService $signer)
    {
        $historial = \App\Models\HistorialClinico::with(['paciente', 'recetas', 'diagnosticos', 'seguimientos'])->findOrFail($id);

        $pdf = Pdf::loadView('reportes.historial-unico', compact('historial'));
        $pdfContent = $pdf->output();
        
        // Firmar el PDF
        $pdfContent = $signer->firmar($pdfContent);
        
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="consulta_' . $historial->fecha_consulta->format('Ymd') . '_' . $historial->paciente->nombre_completo . '.pdf"');
    }

       public function historialesRango(\Illuminate\Http\Request $request, \App\Services\PdfSignerService $signer)
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        
        $historiales = \App\Models\HistorialClinico::with(['paciente'])
            ->whereBetween('fecha_consulta', [$fechaInicio, $fechaFin])
            ->orderBy('fecha_consulta', 'desc')
            ->get();

        $pdf = Pdf::loadView('reportes.historiales-rango', compact('historiales', 'fechaInicio', 'fechaFin'));
        $pdfContent = $pdf->output();
        
        // Firmar el PDF
        $pdfContent = $signer->firmar($pdfContent);
        
        return response($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="historiales_' . $fechaInicio . '_' . $fechaFin . '.pdf"');
    }
}