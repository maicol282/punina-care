<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        return view('citas.index');
    }

    public function getEventos()
    {
        $citas = Seguimiento::with('historialClinico.paciente')
            ->whereNotNull('proxima_cita')
            ->get();

        $eventos = [];

        foreach ($citas as $cita) {
            $eventos[] = [
                'id' => $cita->id,
                'title' => $cita->historialClinico->paciente->nombre_completo,
                'start' => $cita->proxima_cita->format('Y-m-d'),
                'url' => route('historial.show', $cita->historialClinico),
                'backgroundColor' => '#3498db',
                'borderColor' => '#2980b9',
                'extendedProps' => [
                    'telefono' => $cita->historialClinico->paciente->telefono,
                    'diagnostico' => $cita->historialClinico->diagnostico,
                    'medicamento' => optional($cita->historialClinico->recetas->first())->medicamento ?? 'No especificado'
                ]
            ];
        }

        return response()->json($eventos);
    }
}