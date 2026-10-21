<?php

namespace App\Http\Controllers;

use App\Models\PedidoExamen;
use App\Models\Examen;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoExamenController extends Controller
{
    /**
     * Mostrar el formulario para crear un pedido de exámenes.
     */
        public function create(Request $request)
    {
        $paciente = Paciente::findOrFail($request->paciente_id);
        
        // Buscamos el historial clínico si viene en la petición
        $historial = null;
        $motivoAuto = '';
        $diagnosticoAuto = '';

        if ($request->historial_id) {
            $historial = \App\Models\HistorialClinico::with('diagnosticos')->findOrFail($request->historial_id);
            
            // Autocompletar el motivo con el motivo de consulta del historial
            $motivoAuto = $historial->motivo_consulta;
            
            // Autocompletar el diagnóstico extrayendo los códigos CIE-10
            if ($historial->diagnosticos && $historial->diagnosticos->count() > 0) {
                $diagnosticosTexto = [];
                foreach ($historial->diagnosticos as $diag) {
                    $texto = $diag->cie10_code ? $diag->cie10_code . ' - ' : '';
                    $texto .= $diag->descripcion;
                    $diagnosticosTexto[] = $texto;
                }
                $diagnosticoAuto = implode(' | ', $diagnosticosTexto);
            }
        }
        
        $examenes = Examen::all()->groupBy(['categoria', 'subcategoria']);
        
        return view('pedidos-examenes.create', compact('paciente', 'historial', 'examenes', 'motivoAuto', 'diagnosticoAuto'));
    }
    /**
     * Guardar el pedido en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_pedido' => 'required|date',
            'examenes' => 'nullable|array',
            'examenes.*' => 'exists:examenes,id',
        ]);

        if (empty($request->examenes) && empty($request->otros_examenes)) {
            return back()->withErrors(['examenes' => 'Debe seleccionar al menos un examen o especificar uno en "Otros".']);
        }

        // Crear el pedido
        $pedido = PedidoExamen::create([
            'paciente_id' => $request->paciente_id,
            'historial_clinico_id' => $request->historial_id,
            'medico_id' => Auth::id(),
            'fecha_pedido' => $request->fecha_pedido,
            'motivo' => $request->motivo,
            'resumen_clinico' => $request->resumen_clinico,
            'diagnostico_cie10' => $request->diagnostico_cie10,
            'estado' => 'pendiente',
        ]);

        // Guardar los exámenes del catálogo
        if ($request->examenes) {
            foreach ($request->examenes as $examenId) {
                $pedido->detalles()->create([
                    'examen_id' => $examenId,
                ]);
            }
        }

        // Guardar el examen "Otros" (si lo escribió)
        if ($request->otros_examenes) {
            // Creamos un examen genérico "Otros" si no existe
            $examenOtros = Examen::firstOrCreate(
                ['nombre' => 'Otros (Especificar)', 'categoria' => 'Otros', 'subcategoria' => 'Personalizado'],
                ['codigo' => null, 'precio' => null]
            );

            $pedido->detalles()->create([
                'examen_id' => $examenOtros->id,
                'observaciones' => $request->otros_examenes,
            ]);
        }

        return redirect()->route('pacientes.show', $request->paciente_id)
            ->with('success', 'Pedido de exámenes creado exitosamente.');
    }

    /**
     * Mostrar los pedidos de un paciente.
     */
       public function index(Request $request)
    {
        // Si viene un paciente_id, filtramos por ese paciente
        if ($request->has('paciente_id')) {
            $paciente = Paciente::findOrFail($request->paciente_id);
            $pedidos = PedidoExamen::where('paciente_id', $paciente->id)
                ->with(['medico', 'detalles.examen', 'paciente'])
                ->orderBy('fecha_pedido', 'desc')
                ->get();
            return view('pedidos-examenes.index', compact('paciente', 'pedidos'));
        }

        // Si no viene paciente_id, mostramos TODOS los pedidos
        $pedidos = PedidoExamen::with(['medico', 'detalles.examen', 'paciente'])
            ->orderBy('fecha_pedido', 'desc')
            ->paginate(15);
            
        return view('pedidos-examenes.index', compact('pedidos'));
    }

        /**
     * Generar el PDF del pedido.
     */
    public function pdf(PedidoExamen $pedido)
    {
        $pedido->load(['paciente', 'medico', 'detalles.examen']);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pedidos-examenes.pdf', compact('pedido'));
        return $pdf->download('pedido-examenes-' . $pedido->id . '.pdf');
    }
}