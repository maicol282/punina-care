<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\HistorialClinico;
use App\Models\Receta;
use Illuminate\Http\Request;

class BusquedaGlobalController extends Controller
{
    public function buscar(Request $request)
    {
        $termino = $request->get('q', '');
        
        if (strlen($termino) < 2) {
            return response()->json([]);
        }
        
        $resultados = [
            'pacientes' => $this->buscarPacientes($termino),
            'historiales' => $this->buscarHistoriales($termino),
            'recetas' => $this->buscarRecetas($termino)
        ];
        
        return response()->json($resultados);
    }
    
    private function buscarPacientes($termino)
    {
        return Paciente::where('nombre', 'LIKE', "%{$termino}%")
            ->orWhere('apellido', 'LIKE', "%{$termino}%")
            ->orWhere('email', 'LIKE', "%{$termino}%")
            ->orWhere('telefono', 'LIKE', "%{$termino}%")
            ->orWhere('cedula', 'LIKE', "%{$termino}%")
            ->limit(5)
            ->get()
            ->map(function($paciente) {
                return [
                    'id' => $paciente->id,
                    'tipo' => 'paciente',
                    'icono' => 'fas fa-user',
                    'titulo' => $paciente->nombre_completo,
                    'descripcion' => 'Cédula: ' . ($paciente->cedula ?? 'N/A') . ' | ' . $paciente->telefono,
                    'url' => route('pacientes.show', $paciente)
                ];
            });
    }
    
    private function buscarHistoriales($termino)
    {
        return HistorialClinico::with('paciente')
            ->where('motivo_consulta', 'LIKE', "%{$termino}%")
            ->orWhere('diagnostico', 'LIKE', "%{$termino}%")
            ->orWhereHas('paciente', function($query) use ($termino) {
                $query->where('nombre', 'LIKE', "%{$termino}%")
                      ->orWhere('apellido', 'LIKE', "%{$termino}%");
            })
            ->limit(5)
            ->get()
            ->map(function($historial) {
                return [
                    'id' => $historial->id,
                    'tipo' => 'historial',
                    'icono' => 'fas fa-notes-medical',
                    'titulo' => $historial->paciente->nombre_completo,
                    'descripcion' => $historial->fecha_consulta->format('d/m/Y') . ' - ' . $historial->motivo_consulta,
                    'url' => route('historial.show', $historial)
                ];
            });
    }
    
    private function buscarRecetas($termino)
    {
        return Receta::with('historialClinico.paciente')
            ->where('medicamento', 'LIKE', "%{$termino}%")
            ->orWhere('indicaciones', 'LIKE', "%{$termino}%")
            ->limit(5)
            ->get()
            ->map(function($receta) {
                return [
                    'id' => $receta->id,
                    'tipo' => 'receta',
                    'icono' => 'fas fa-prescription-bottle',
                    'titulo' => $receta->medicamento,
                    'descripcion' => $receta->historialClinico->paciente->nombre_completo . ' - ' . $receta->fecha_emision->format('d/m/Y'),
                    'url' => route('recetas.index', $receta->historialClinico)
                ];
            });
    }
}