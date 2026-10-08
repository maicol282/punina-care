<?php

namespace App\Http\Controllers;

use App\Models\Reposo;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ReposoController extends Controller
{
  

    public function index(Request $request)
    {
        $query = Reposo::with(['paciente', 'historialClinico'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('paciente_id')) {
            $query->where('paciente_id', $request->paciente_id);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('paciente', function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido', 'LIKE', "%{$search}%")
                  ->orWhere('cedula', 'LIKE', "%{$search}%");
            });
        }

        $reposos = $query->paginate(15);
        $pacientes = Paciente::orderBy('nombre')->get();
        $estados = ['activo', 'completado', 'anulado'];

        return view('reposos.index', compact('reposos', 'pacientes', 'estados'));
    }

    public function create(HistorialClinico $historial)
    {
        $paciente = $historial->paciente;
        return view('reposos.create', compact('historial', 'paciente'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'historial_clinico_id' => 'required|exists:historial_clinicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'dias' => 'nullable|integer|min:1',
            'tipo' => 'required|in:laboral,escolar,otro',
            'diagnostico' => 'required|string|max:500',
            'recomendaciones' => 'nullable|string|max:500',
            'medico_emisor' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fechaInicio = new \DateTime($request->fecha_inicio);
        $fechaFin = new \DateTime($request->fecha_fin);
        $dias = $request->dias ?? $fechaInicio->diff($fechaFin)->days + 1;

        $reposo = Reposo::create([
            'historial_clinico_id' => $request->historial_clinico_id,
            'paciente_id' => $request->paciente_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'dias' => $dias,
            'tipo' => $request->tipo,
            'diagnostico' => $request->diagnostico,
            'recomendaciones' => $request->recomendaciones,
            'medico_emisor' => $request->medico_emisor,
            'numero_reposo' => Reposo::generarNumero(),
            'estado' => 'activo'
        ]);

        return redirect()->route('reposos.show', $reposo)
            ->with('success', 'Reposo médico creado exitosamente. Número: ' . $reposo->numero_reposo);
    }

    public function show(Reposo $reposo)
    {
        $reposo->load(['paciente', 'historialClinico']);
        return view('reposos.show', compact('reposo'));
    }

    public function edit(Reposo $reposo)
    {
        $reposo->load(['paciente', 'historialClinico']);
        return view('reposos.edit', compact('reposo'));
    }

    public function update(Request $request, Reposo $reposo)
    {
        $validator = Validator::make($request->all(), [
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'dias' => 'nullable|integer|min:1',
            'tipo' => 'required|in:laboral,escolar,otro',
            'diagnostico' => 'required|string|max:500',
            'recomendaciones' => 'nullable|string|max:500',
            'estado' => 'required|in:activo,completado,anulado',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reposo->update($request->all());

        return redirect()->route('reposos.show', $reposo)
            ->with('success', 'Reposo actualizado exitosamente.');
    }

    public function destroy(Reposo $reposo)
    {
        $reposo->delete();
        return redirect()->route('reposos.index')
            ->with('success', 'Reposo eliminado exitosamente.');
    }

    public function imprimir(Reposo $reposo)
    {
        $reposo->load(['paciente', 'historialClinico']);
        $pdf = Pdf::loadView('reposos.pdf', compact('reposo'));
        return $pdf->download('reposo-' . $reposo->numero_reposo . '.pdf');
    }

    public function cambiarEstado(Request $request, Reposo $reposo)
    {
        $request->validate([
            'estado' => 'required|in:activo,completado,anulado'
        ]);

        $reposo->update(['estado' => $request->estado]);

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado exitosamente.',
            'estado' => $reposo->estado
        ]);
    }
}