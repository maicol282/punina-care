<?php

namespace App\Http\Controllers;

use App\Models\TerminoAprendido;
use Illuminate\Http\Request;

class AutocompletadoController extends Controller
{
    public function search(Request $request)
    {
        $campo = $request->get('campo');
        $termino = $request->get('q', '');
        
        if (strlen($termino) < 2) {
            return response()->json([]);
        }
        
        // Búsqueda sin distinción de mayúsculas/minúsculas
        $sugerencias = TerminoAprendido::where('campo', $campo)
            ->whereRaw('LOWER(termino) LIKE ?', ['%' . strtolower($termino) . '%'])
            ->orderBy('veces_usado', 'desc')
            ->limit(10)
            ->get()
            ->pluck('termino');
        
        return response()->json($sugerencias);
    }

    /**
     * Guardar término aprendido
     */
    public function save(Request $request)
    {
        $campo = $request->get('campo');
        $termino = trim($request->get('termino'));
        
        if (empty($termino) || strlen($termino) < 3) {
            return response()->json(['success' => false]);
        }
        
        $existente = TerminoAprendido::where('campo', $campo)
            ->where('termino', $termino)
            ->first();
        
        if ($existente) {
            $existente->increment('veces_usado');
        } else {
            TerminoAprendido::create([
                'campo' => $campo,
                'termino' => $termino,
                'veces_usado' => 1
            ]);
        }
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Precargar términos iniciales
     */
    public function precargar()
    {
        $terminosIniciales = [
            'motivo_consulta' => [
                'Dolor de cabeza', 'Dolor abdominal', 'Fiebre', 'Tos seca',
                'Dificultad para respirar', 'Dolor de garganta', 'Náuseas y vómitos',
                'Diarrea', 'Cansancio general', 'Mareos', 'Dolor en el pecho',
                'Palpitaciones', 'Insomnio', 'Ansiedad', 'Dolor lumbar',
                'Dolor articular', 'Pérdida de peso', 'Aumento de peso'
            ],
            'diagnostico' => [
                'Hipertensión arterial', 'Diabetes mellitus tipo 2', 'Infección respiratoria aguda',
                'Infección urinaria', 'Gastritis', 'Asma bronquial', 'EPOC',
                'Dengue', 'COVID-19', 'Gripe estacional', 'Neumonía',
                'Bronquitis aguda', 'Sinusitis', 'Faringoamigdalitis'
            ],
            'tratamiento' => [
                'Reposo absoluto', 'Hidratación oral', 'Paracetamol 500mg cada 8 horas',
                'Ibuprofeno 400mg cada 8 horas', 'Amoxicilina 500mg cada 8 horas',
                'Losartán 50mg cada 24 horas', 'Metformina 850mg cada 12 horas',
                'Omeprazol 20mg cada 24 horas', 'Salbutamol inhalador'
            ],
            'medicamentos' => [
                'Paracetamol 500mg', 'Ibuprofeno 400mg', 'Amoxicilina 500mg',
                'Omeprazol 20mg', 'Losartán 50mg', 'Metformina 850mg',
                'Enalapril 10mg', 'Atorvastatina 20mg', 'Aspirina 100mg'
            ]
        ];
        
        foreach ($terminosIniciales as $campo => $terminos) {
            foreach ($terminos as $termino) {
                TerminoAprendido::updateOrCreate(
                    ['campo' => $campo, 'termino' => $termino],
                    ['veces_usado' => 1]
                );
            }
        }
        
        return response()->json(['success' => true, 'message' => 'Términos precargados']);
    }
}