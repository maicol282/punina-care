<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use App\Models\Seguimiento;
use App\Models\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SeguimientoController extends Controller
{
    public function create(HistorialClinico $historial)
    {
        return view('seguimientos.create', compact('historial'));
    }

    public function store(Request $request, HistorialClinico $historial)
    {
        $validated = $request->validate([
            'fecha_seguimiento' => 'required|date',
            'evolucion' => 'required|string',
            'nuevos_sintomas' => 'nullable|string',
            'medicamentos_ajustados' => 'nullable|string',
            'recomendaciones' => 'required|string',
            'proxima_cita' => 'nullable|date|after:today',
            // Validación para receta
            'receta_medicamentos' => 'nullable|array',
            'receta_medicamentos.*.medicamento' => 'nullable|string',
            'receta_medicamentos.*.presentacion' => 'nullable|string',
            'receta_medicamentos.*.concentracion' => 'nullable|string',
            'receta_medicamentos.*.dosis' => 'nullable|string',
            'receta_medicamentos.*.frecuencia' => 'nullable|string',
            'receta_medicamentos.*.duracion' => 'nullable|string',
            'receta_medicamentos.*.indicaciones' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Crear el seguimiento
            $seguimiento = new Seguimiento();
            $seguimiento->historial_clinico_id = $historial->id;
            $seguimiento->fecha_seguimiento = $request->fecha_seguimiento;
            $seguimiento->evolucion = $request->evolucion;
            $seguimiento->nuevos_sintomas = $request->nuevos_sintomas;
            $seguimiento->medicamentos_ajustados = $request->medicamentos_ajustados;
            $seguimiento->recomendaciones = $request->recomendaciones;
            $seguimiento->proxima_cita = $request->proxima_cita;
            $seguimiento->save();

            // ===== GUARDAR RECETA MÉDICA (SOLO SI SE ACTIVÓ) =====
            if ($request->has('generar_receta') && $request->generar_receta == '1') {
                $medicamentos = $request->receta_medicamentos;
                
                if ($medicamentos && count($medicamentos) > 0) {
                    // Limpiar medicamentos vacíos
                    $medicamentosValidos = array_filter($medicamentos, function($med) {
                        return !empty($med['medicamento']);
                    });
                    
                    if (count($medicamentosValidos) > 0) {
                        // Buscar si ya existe una receta para este historial
                        $receta = Receta::where('historial_clinico_id', $historial->id)->first();
                        
                        if (!$receta) {
                            $receta = new Receta();
                            $receta->historial_clinico_id = $historial->id;
                        }
                        
                        $receta->fecha_emision = $request->receta_fecha_emision ?? now();
                        $receta->medicamentos_json = json_encode($medicamentosValidos);
                        $receta->advertencias = $request->receta_advertencias;
                        $receta->signos_alarma = $request->receta_signos_alarma;
                        $receta->recomendaciones_no_farmacologicas = $request->receta_recomendaciones_no_farmacologicas;
                        $receta->save();
                        
                        Log::info("Receta médica generada desde seguimiento", [
                            'seguimiento_id' => $seguimiento->id,
                            'historial_id' => $historial->id,
                            'medicamentos' => count($medicamentosValidos)
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('historial.show', $historial)
                ->with('success', 'Seguimiento registrado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error guardando seguimiento: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al guardar el seguimiento: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit(Seguimiento $seguimiento)
    {
        return view('seguimientos.edit', compact('seguimiento'));
    }

    public function update(Request $request, Seguimiento $seguimiento)
    {
        $validated = $request->validate([
            'fecha_seguimiento' => 'required|date',
            'evolucion' => 'required|string',
            'nuevos_sintomas' => 'nullable|string',
            'medicamentos_ajustados' => 'nullable|string',
            'recomendaciones' => 'required|string',
            'proxima_cita' => 'nullable|date',
            // Validación para receta
            'receta_medicamentos' => 'nullable|array',
            'receta_medicamentos.*.medicamento' => 'nullable|string',
            'receta_medicamentos.*.presentacion' => 'nullable|string',
            'receta_medicamentos.*.concentracion' => 'nullable|string',
            'receta_medicamentos.*.dosis' => 'nullable|string',
            'receta_medicamentos.*.frecuencia' => 'nullable|string',
            'receta_medicamentos.*.duracion' => 'nullable|string',
            'receta_medicamentos.*.indicaciones' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $seguimiento->update($validated);

            // ===== ACTUALIZAR RECETA MÉDICA (SOLO SI SE ACTIVÓ) =====
            if ($request->has('generar_receta') && $request->generar_receta == '1') {
                $medicamentos = $request->receta_medicamentos;
                
                if ($medicamentos && count($medicamentos) > 0) {
                    $medicamentosValidos = array_filter($medicamentos, function($med) {
                        return !empty($med['medicamento']);
                    });
                    
                    if (count($medicamentosValidos) > 0) {
                        $historial = $seguimiento->historialClinico;
                        $receta = Receta::where('historial_clinico_id', $historial->id)->first();
                        
                        if (!$receta) {
                            $receta = new Receta();
                            $receta->historial_clinico_id = $historial->id;
                        }
                        
                        $receta->fecha_emision = $request->receta_fecha_emision ?? now();
                        $receta->medicamentos_json = json_encode($medicamentosValidos);
                        $receta->advertencias = $request->receta_advertencias;
                        $receta->signos_alarma = $request->receta_signos_alarma;
                        $receta->recomendaciones_no_farmacologicas = $request->receta_recomendaciones_no_farmacologicas;
                        $receta->save();
                    }
                }
            }

            DB::commit();

            return redirect()->route('historial.show', $seguimiento->historialClinico)
                ->with('success', 'Seguimiento actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error actualizando seguimiento: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al actualizar el seguimiento: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Seguimiento $seguimiento)
    {
        $historialId = $seguimiento->historial_clinico_id;
        $seguimiento->delete();
        
        return redirect()->route('historial.show', $historialId)
            ->with('success', 'Seguimiento eliminado exitosamente.');
    }

    public function show(Seguimiento $seguimiento)
    {
        $seguimiento->load(['historialClinico.paciente', 'historialClinico.recetas']);
        return view('seguimientos.show', compact('seguimiento'));
    }
}