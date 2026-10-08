<?php

namespace App\Http\Controllers;

use App\Models\Cie10Code;
use Illuminate\Http\Request;

class Cie10Controller extends Controller
{
    public function search(Request $request)
    {
        $term = trim($request->get('q', ''));
        
        if (strlen($term) < 1) {
            return response()->json([]);
        }
        
        // Determinar si es búsqueda por código
        $esCodigo = preg_match('/^[A-Za-z][0-9]/', $term);
        
        if ($esCodigo) {
            // Búsqueda por código exacto
            $results = Cie10Code::where('codigo', 'LIKE', "%{$term}%")
                ->orderBy('codigo')
                ->limit(50)
                ->get();
        } else {
            // Búsqueda por diagnóstico - palabra completa
            $results = Cie10Code::where('diagnostico', 'LIKE', "%{$term}%")
                ->orderBy('codigo')
                ->limit(50)
                ->get();
        }
        
        $results = $results->map(function($item) {
            return [
                'codigo' => $item->codigo,
                'diagnostico' => $item->diagnostico,
            ];
        });
        
        return response()->json($results);
    }
    
    public function getByCode($codigo)
    {
        $cie10 = Cie10Code::where('codigo', $codigo)->first();
        
        if ($cie10) {
            return response()->json([
                'success' => true,
                'codigo' => $cie10->codigo,
                'diagnostico' => $cie10->diagnostico
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Código CIE-10 no encontrado'
        ]);
    }

    public function getByDiagnostico(Request $request)
    {
        $diagnostico = trim($request->get('diagnostico', ''));
        
        if (strlen($diagnostico) < 2) {
            return response()->json(null);
        }
        
        $cie10 = Cie10Code::where('diagnostico', 'LIKE', "%{$diagnostico}%")
            ->orderBy('codigo')
            ->first();
        
        if ($cie10) {
            return response()->json([
                'success' => true,
                'codigo' => $cie10->codigo,
                'diagnostico' => $cie10->diagnostico
            ]);
        }
        
        return response()->json(null);
    }

    public function autocomplete(Request $request)
    {
        $term = trim($request->get('term', ''));
        
        if (strlen($term) < 1) {
            return response()->json([]);
        }
        
        $results = Cie10Code::where('diagnostico', 'LIKE', "%{$term}%")
            ->orderBy('codigo')
            ->limit(50)
            ->get()
            ->map(function($item) {
                return [
                    'codigo' => $item->codigo,
                    'diagnostico' => $item->diagnostico,
                ];
            });
        
        return response()->json($results);
    }
}
