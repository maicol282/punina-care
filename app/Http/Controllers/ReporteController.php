<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Generar PDF del historial completo de un paciente
     */
    public function historialPaciente(Paciente $paciente)
    {
        $paciente->load(['historialClinicos.seguimientos']);
        
        $pdf = Pdf::loadView('reportes.historial-paciente', compact('paciente'));
        
        return $pdf->download('historial_' . $paciente->nombre_completo . '_' . now()->format('Ymd_His') . '.pdf');
    }

    /**
     * Generar PDF de un historial específico
     */
    public function historialUnico(HistorialClinico $historial)
    {
            $historial->load(['paciente', 'seguimientos']);
        
        $pdf = Pdf::loadView('reportes.historial-unico', compact('historial'));
        
        return $pdf->download('consulta_' . $historial->fecha_consulta->format('Ymd') . '_' . $historial->paciente->nombre_completo . '.pdf');
    }

    /**
     * Generar PDF de todos los historiales por rango de fechas
     */
    public function historialPorFecha(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
        
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;
        
        $historiales = HistorialClinico::with('paciente')
            ->whereBetween('fecha_consulta', [$fechaInicio, $fechaFin])
            ->orderBy('fecha_consulta', 'desc')
            ->get();
        
        $pdf = Pdf::loadView('reportes.historiales-rango', compact('historiales', 'fechaInicio', 'fechaFin'));
        
        return $pdf->download('consultas_' . $fechaInicio . '_a_' . $fechaFin . '.pdf');
    }
}