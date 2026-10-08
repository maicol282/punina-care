<?php

namespace App\Http\Controllers;

use App\Models\TerminoPredictivo;
use App\Models\Cie10Code;
use Illuminate\Http\Request;

class TextoPredictivoController extends Controller
{
    public function search(Request $request)
    {
        $campo = $request->get('campo');
        $termino = $request->get('q', '');
        
        if (strlen($termino) < 2) {
            return response()->json([]);
        }
        
        // Buscar en términos guardados
        $sugerencias = TerminoPredictivo::where('campo', $campo)
            ->where('termino', 'LIKE', "%{$termino}%")
            ->orderBy('veces_usado', 'desc')
            ->limit(8)
            ->get()
            ->pluck('termino')
            ->toArray();
        
        // Para el campo diagnóstico, también incluir términos CIE-10
        if ($campo === 'diagnostico') {
            $cie10Terminos = Cie10Code::where('diagnostico', 'LIKE', "%{$termino}%")
                ->limit(5)
                ->get()
                ->pluck('diagnostico')
                ->toArray();
            
            $sugerencias = array_merge($sugerencias, $cie10Terminos);
            $sugerencias = array_unique($sugerencias);
            $sugerencias = array_slice($sugerencias, 0, 10);
        }
        
        return response()->json($sugerencias);
    }
    
    public function save(Request $request)
    {
        $campo = $request->get('campo');
        $termino = trim($request->get('termino'));
        
        if (empty($termino) || strlen($termino) < 3) {
            return response()->json(['success' => false]);
        }
        
        $existente = TerminoPredictivo::where('campo', $campo)
            ->where('termino', $termino)
            ->first();
        
        if ($existente) {
            $existente->increment('veces_usado');
        } else {
            TerminoPredictivo::create([
                'campo' => $campo,
                'termino' => $termino,
                'veces_usado' => 1
            ]);
        }
        
        return response()->json(['success' => true]);
    }
    
    // Método para precargar términos iniciales
    public function precargar()
    {
        $terminosIniciales = [
            'motivo_consulta' => [
                'Dolor de cabeza', 'Dolor abdominal', 'Fiebre', 'Tos seca', 
                'Dificultad para respirar', 'Dolor de garganta', 'Náuseas y vómitos',
                'Diarrea', 'Cansancio general', 'Mareos', 'Dolor en el pecho'
            ],
            'diagnostico' => [
                'Hipertensión arterial', 'Diabetes mellitus tipo 2', 'Infección respiratoria aguda',
                'Infección urinaria', 'Gastritis', 'Asma bronquial'
            ],
            'medicamentos' => [
                'Paracetamol 500mg', 'Ibuprofeno 400mg', 'Amoxicilina 500mg',
                'Omeprazol 20mg', 'Losartán 50mg', 'Metformina 850mg'
            ]
        ];
        
        foreach ($terminosIniciales as $campo => $terminos) {
            foreach ($terminos as $termino) {
                TerminoPredictivo::updateOrCreate(
                    ['campo' => $campo, 'termino' => $termino],
                    ['veces_usado' => 1]
                );
            }
        }
        
        return response()->json(['success' => true, 'message' => 'Términos precargados']);
    }
}