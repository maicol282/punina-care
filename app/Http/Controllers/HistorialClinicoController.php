<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Diagnostico;
use App\Models\EstudioAdjunto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class HistorialClinicoController extends Controller
{
    public function index()
    {
        $historiales = HistorialClinico::with('paciente')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('historial.index', compact('historiales'));
    }

    public function create(Paciente $paciente)
    {
        $medicos = User::whereHas('roles', function($query) {
            $query->where('name', 'medico');
        })->get();
        
        return view('historial.create', compact('paciente', 'medicos'));
    }

    public function store(Request $request, Paciente $paciente)
    {
        $request->validate([
            'fecha_consulta' => 'required|date',
            'motivo_consulta' => 'required|string',
            'doctor' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
            'archivos.*' => 'nullable|file|max:10240|mimes:jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx',
        ]);

        try {
            DB::beginTransaction();

            $historial = new HistorialClinico();
            $historial->paciente_id = $paciente->id;
            $historial->fecha_consulta = $request->fecha_consulta;
            $historial->motivo_consulta = $request->motivo_consulta;
            $historial->doctor = $request->doctor;
            $historial->presion_arterial = $request->presion_arterial;
            $historial->fc = $request->fc;
            $historial->sat = $request->sat;
            $historial->fr = $request->fr;
            $historial->temperatura = $request->temperatura;
            $historial->peso = $request->peso;
            $historial->altura = $request->altura;
            $historial->masa_corporal = $request->masa_corporal;
            
            // Antecedentes Patológicos
            $historial->hospitalizaciones = $request->hospitalizaciones;
            $historial->cardiovasculares = $request->cardiovasculares;
            $historial->pulmonales = $request->pulmonales;
            $historial->digestivos = $request->digestivos;
            $historial->diabetes = $request->diabetes;
            $historial->renales = $request->renales;
            $historial->quirurgicos = $request->quirurgicos;
            $historial->transfusiones = $request->transfusiones;
            $historial->alergias_patologicas = $request->alergias_patologicas;
            $historial->otros_patologicos = $request->otros_patologicos;
            
            // Antecedentes No Patológicos
            $historial->alcohol = $request->alcohol;
            $historial->tabaquismo = $request->tabaquismo;
            $historial->drogas = $request->drogas;
            $historial->inmunizaciones = $request->inmunizaciones;
            $historial->otros_no_patologicos = $request->otros_no_patologicos;
            
            // Antecedentes Familiares
            $historial->antecedentes_familiares = $request->antecedentes_familiares;
            $historial->familiares_no_refiere = $request->has('familiares_no_refiere');
            
            $familiares = [
                'familiar_hipertension', 'familiar_diabetes', 'familiar_cardiopatias',
                'familiar_cancer', 'familiar_obesidad', 'familiar_dislipidemia',
                'familiar_enfermedad_renal', 'familiar_enfermedad_tiroidea',
                'familiar_enfermedad_mental', 'familiar_tuberculosis',
                'familiar_alcoholismo', 'familiar_otras'
            ];
            
            foreach ($familiares as $campo) {
                $historial->$campo = $request->has($campo);
            }
            
            // Gineco Obstétricos
            $historial->menarquia = $request->menarquia;
            $historial->ritmo = $request->ritmo;
            $historial->fmu = $request->fmu;
            $historial->gestas = $request->gestas;
            $historial->partos = $request->partos;
            $historial->abortos = $request->abortos;
            $historial->cesareas = $request->cesareas;
            $historial->hijos_vivos = $request->hijos_vivos;
            $historial->num_parejas_sexuales = $request->num_parejas_sexuales;
            $historial->menopausia = $request->menopausia;
            $historial->usa_anticonceptivos = $request->has('usa_anticonceptivos');
            $historial->cuales_anticonceptivos = $request->cuales_anticonceptivos;
            
            // Exploración Física
            $exploraciones = [
                'cabeza', 'cuello', 'torax', 'abdomen', 'extremidades',
                'neurologico', 'piel', 'columna', 'pelvis', 'axilas', 'mamas'
            ];
            
            foreach ($exploraciones as $campo) {
                $historial->$campo = $request->$campo;
                $tipoCampo = $campo . '_tipo';
                $historial->$tipoCampo = $request->$tipoCampo ?? 'SP';
            }
            
            $historial->estado_mental = $request->estado_mental;
            $historial->laboratorio = $request->laboratorio;
            $historial->estudio_imagen = $request->estudio_imagen;
            $historial->otros_exploracion = $request->otros_exploracion;
            $historial->enfermedad_actual = $request->enfermedad_actual;
            $historial->tratamiento = $request->tratamiento;
            $historial->recomendaciones = $request->recomendaciones;
            $historial->observaciones = $request->observaciones;

            // ===== REVISIÓN DE ÓRGANOS Y SISTEMAS =====
            $sistemas = [
                'cardiovascular', 'respiratorio', 'digestivo', 'renal', 'neurologico',
                'musculoesqueletico', 'endocrino', 'hematologico', 'linfatico',
                'genitourinario', 'piel', 'oftalmologico', 'orl', 'psiquiatrico'
            ];

            foreach ($sistemas as $sistema) {
            $campo = 'sist_' . $sistema;
            $obsCampo = $campo . '_obs';
            $historial->$campo = $request->$campo ?? 'SP';
            $historial->$obsCampo = $request->$obsCampo;
        }
        $historial->observaciones_sistemas = $request->observaciones_sistemas;
                    if (isset($paciente->fecha_nacimiento)) {
            $edad = Carbon::parse($paciente->fecha_nacimiento)->age;
            if ($edad < 15) {
                $historial->presion_arterial = 'N/A (Paciente pediátrico)';
            }
        }
            $historial->save();

            // Guardar Diagnósticos
            if ($request->has('diagnosticos')) {
                foreach ($request->diagnosticos as $index => $diagData) {
                    if (!empty($diagData['descripcion'])) {
                        Diagnostico::create([
                            'historial_clinico_id' => $historial->id,
                            'descripcion' => $diagData['descripcion'],
                            'cie10_code' => $diagData['cie10'] ?? null,
                            'tipo' => $diagData['tipo'] ?? 'PRE',
                            'orden' => $index
                        ]);
                    }
                }
            }

            // ===== GUARDAR ARCHIVOS ADJUNTOS POR CATEGORÍA =====
            $categorias = [
                'laboratorio' => 'Laboratorio',
                'imagen' => 'Imagen',
                'otros' => 'Otros'
            ];

            foreach ($categorias as $key => $categoria) {
                $fieldName = 'archivos_' . $key;
                if ($request->hasFile($fieldName)) {
                    $carpeta = 'estudios/' . $historial->id . '/' . $key;
                    
                    foreach ($request->file($fieldName) as $archivo) {
                        $nombreOriginal = $archivo->getClientOriginalName();
                        $extension = $archivo->getClientOriginalExtension();
                        $nombreGuardado = time() . '_' . uniqid() . '.' . $extension;
                        
                        $ruta = $archivo->storeAs($carpeta, $nombreGuardado, 'public');
                        
                        EstudioAdjunto::create([
                            'historial_clinico_id' => $historial->id,
                            'nombre_original' => $nombreOriginal,
                            'nombre_guardado' => $nombreGuardado,
                            'ruta' => $ruta,
                            'tipo_archivo' => $archivo->getMimeType(),
                            'mime_type' => $archivo->getMimeType(),
                            'tamano' => $archivo->getSize(),
                            'descripcion' => $request->input($key),
                            'categoria' => $categoria
                        ]);
                    }
                }
            }
// ===== GUARDAR RECETA MÉDICA =====
if ($request->has('generar_receta') && $request->generar_receta == '1') {
    $medicamentos = $request->receta_medicamentos;
    
    if ($medicamentos && count($medicamentos) > 0) {
        // Limpiar medicamentos vacíos
        $medicamentosValidos = array_filter($medicamentos, function($med) {
            return !empty($med['medicamento']);
        });
        
        if (count($medicamentosValidos) > 0) {
            $receta = new \App\Models\Receta();
            $receta->historial_clinico_id = $historial->id;
            $receta->fecha_emision = $request->receta_fecha_emision ?? now();
            $receta->medicamentos_json = json_encode($medicamentosValidos);
            $receta->medicamento = $medicamentosValidos[0]['medicamento'] ?? null; // Para compatibilidad
            $receta->presentacion = $medicamentosValidos[0]['presentacion'] ?? null;
            $receta->concentracion = $medicamentosValidos[0]['concentracion'] ?? null;
            $receta->dosis = $medicamentosValidos[0]['dosis'] ?? null;
            $receta->frecuencia = $medicamentosValidos[0]['frecuencia'] ?? null;
            $receta->duracion = $medicamentosValidos[0]['duracion'] ?? null;
            $receta->indicaciones = $medicamentosValidos[0]['indicaciones'] ?? null;
            $receta->advertencias = $request->receta_advertencias;
            $receta->signos_alarma = $request->receta_signos_alarma;
            $receta->recomendaciones_no_farmacologicas = $request->receta_recomendaciones_no_farmacologicas;
            $receta->save();
            
            Log::info("Receta médica generada automáticamente", [
                'historial_id' => $historial->id,
                'medicamentos' => count($medicamentosValidos)
            ]);
        }
    }
}
            DB::commit();

            $usuario = Auth::user();
            $nombreUsuario = $usuario ? $usuario->name : 'Desconocido';

            Log::info("Historial clínico creado", [
                'historial_id' => $historial->id,
                'paciente_id' => $paciente->id,
                'usuario' => $nombreUsuario
            ]);

            return redirect()->route('pacientes.show', $paciente->id)
                ->with('success', 'Historial clínico guardado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error guardando historial: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al guardar el historial: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Paciente $paciente, HistorialClinico $historial)
    {
        $historial->load([
            'diagnosticos', 
            'recetas', 
            'seguimientos', 
            'adjuntos', 
            'estudiosAdjuntos'
        ]);
        return view('historial.show', compact('paciente', 'historial'));
    }

   public function edit($historialId)
{
    $historial = HistorialClinico::with(['paciente', 'diagnosticos', 'estudiosAdjuntos'])->findOrFail($historialId);
    $paciente = $historial->paciente;
    
    $medicos = User::whereHas('roles', function($query) {
        $query->where('name', 'medico');
    })->get();
    
    return view('historial.edit', compact('paciente', 'historial', 'medicos'));
}

    public function update(Request $request, $historialId)
    {
        $historial = HistorialClinico::with('paciente')->findOrFail($historialId);
        $paciente = $historial->paciente;

        $request->validate([
            'fecha_consulta' => 'required|date',
            'motivo_consulta' => 'required|string',
            'doctor' => 'nullable|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
            'archivos.*' => 'nullable|file|max:10240|mimes:jpeg,png,gif,webp,pdf,doc,docx,xls,xlsx',
        ]);

        try {
            DB::beginTransaction();

            $historial->fecha_consulta = $request->fecha_consulta;
            $historial->motivo_consulta = $request->motivo_consulta;
            $historial->doctor = $request->doctor;
            $historial->presion_arterial = $request->presion_arterial;
            $historial->fc = $request->fc;
            $historial->sat = $request->sat;
            $historial->fr = $request->fr;
            $historial->temperatura = $request->temperatura;
            $historial->peso = $request->peso;
            $historial->altura = $request->altura;
            $historial->masa_corporal = $request->masa_corporal;
            
            // Antecedentes Patológicos
            $historial->hospitalizaciones = $request->hospitalizaciones;
            $historial->cardiovasculares = $request->cardiovasculares;
            $historial->pulmonales = $request->pulmonales;
            $historial->digestivos = $request->digestivos;
            $historial->diabetes = $request->diabetes;
            $historial->renales = $request->renales;
            $historial->quirurgicos = $request->quirurgicos;
            $historial->transfusiones = $request->transfusiones;
            $historial->alergias_patologicas = $request->alergias_patologicas;
            $historial->otros_patologicos = $request->otros_patologicos;
            
            // Antecedentes No Patológicos
            $historial->alcohol = $request->alcohol;
            $historial->tabaquismo = $request->tabaquismo;
            $historial->drogas = $request->drogas;
            $historial->inmunizaciones = $request->inmunizaciones;
            $historial->otros_no_patologicos = $request->otros_no_patologicos;
            
            // Antecedentes Familiares
            $historial->antecedentes_familiares = $request->antecedentes_familiares;
            $historial->familiares_no_refiere = $request->has('familiares_no_refiere');
            
            $familiares = [
                'familiar_hipertension', 'familiar_diabetes', 'familiar_cardiopatias',
                'familiar_cancer', 'familiar_obesidad', 'familiar_dislipidemia',
                'familiar_enfermedad_renal', 'familiar_enfermedad_tiroidea',
                'familiar_enfermedad_mental', 'familiar_tuberculosis',
                'familiar_alcoholismo', 'familiar_otras'
            ];
            
            foreach ($familiares as $campo) {
                $historial->$campo = $request->has($campo);
            }
            
            // Gineco Obstétricos
            $historial->menarquia = $request->menarquia;
            $historial->ritmo = $request->ritmo;
            $historial->fmu = $request->fmu;
            $historial->gestas = $request->gestas;
            $historial->partos = $request->partos;
            $historial->abortos = $request->abortos;
            $historial->cesareas = $request->cesareas;
            $historial->hijos_vivos = $request->hijos_vivos;
            $historial->num_parejas_sexuales = $request->num_parejas_sexuales;
            $historial->menopausia = $request->menopausia;
            $historial->usa_anticonceptivos = $request->has('usa_anticonceptivos');
            $historial->cuales_anticonceptivos = $request->cuales_anticonceptivos;
            
            // Exploración Física
            $exploraciones = [
                'cabeza', 'cuello', 'torax', 'abdomen', 'extremidades',
                'neurologico', 'piel', 'columna', 'pelvis', 'axilas', 'mamas'
            ];
            
            foreach ($exploraciones as $campo) {
                $historial->$campo = $request->$campo;
                $tipoCampo = $campo . '_tipo';
                $historial->$tipoCampo = $request->$tipoCampo ?? 'SP';
            }
            
            $historial->estado_mental = $request->estado_mental;
            $historial->laboratorio = $request->laboratorio;
            $historial->estudio_imagen = $request->estudio_imagen;
            $historial->otros_exploracion = $request->otros_exploracion;
            $historial->enfermedad_actual = $request->enfermedad_actual;
            $historial->tratamiento = $request->tratamiento;
            $historial->recomendaciones = $request->recomendaciones;
            $historial->observaciones = $request->observaciones;

            // ===== REVISIÓN DE ÓRGANOS Y SISTEMAS =====
            $sistemas = [
                'cardiovascular', 'respiratorio', 'digestivo', 'renal', 'neurologico',
                'musculoesqueletico', 'endocrino', 'hematologico', 'linfatico',
                'genitourinario', 'piel', 'oftalmologico', 'orl', 'psiquiatrico'
            ];

            foreach ($sistemas as $sistema) {
                $campo = 'sist_' . $sistema;
                $obsCampo = $campo . '_obs';
                $historial->$campo = $request->$campo ?? 'SP';
                $historial->$obsCampo = $request->$obsCampo;
            }
            $historial->observaciones_sistemas = $request->observaciones_sistemas;
                    if (isset($paciente->fecha_nacimiento)) {
            $edad = Carbon::parse($paciente->fecha_nacimiento)->age;
            if ($edad < 15) {
                $historial->presion_arterial = 'N/A (Paciente pediátrico)';
            }
        }
                        
            $historial->save();

            // Actualizar Diagnósticos
            $historial->diagnosticos()->delete();
            
            if ($request->has('diagnosticos')) {
                foreach ($request->diagnosticos as $index => $diagData) {
                    if (!empty($diagData['descripcion'])) {
                        Diagnostico::create([
                            'historial_clinico_id' => $historial->id,
                            'descripcion' => $diagData['descripcion'],
                            'cie10_code' => $diagData['cie10'] ?? null,
                            'tipo' => $diagData['tipo'] ?? 'PRE',
                            'orden' => $index
                        ]);
                    }
                }
            }

            // ===== GUARDAR NUEVOS ARCHIVOS ADJUNTOS =====
            if ($request->hasFile('archivos')) {
                $carpeta = 'estudios/' . $historial->id;
                
                foreach ($request->file('archivos') as $archivo) {
                    $nombreOriginal = $archivo->getClientOriginalName();
                    $extension = $archivo->getClientOriginalExtension();
                    $nombreGuardado = time() . '_' . uniqid() . '.' . $extension;
                    
                    $ruta = $archivo->storeAs($carpeta, $nombreGuardado, 'public');
                    
                    EstudioAdjunto::create([
                        'historial_clinico_id' => $historial->id,
                        'nombre_original' => $nombreOriginal,
                        'nombre_guardado' => $nombreGuardado,
                        'ruta' => $ruta,
                        'tipo_archivo' => $archivo->getMimeType(),
                        'mime_type' => $archivo->getMimeType(),
                        'tamano' => $archivo->getSize(),
                        'descripcion' => $request->input('descripcion_archivo'),
                        'categoria' => 'estudio'
                    ]);
                }
            }

            // ===== ELIMINAR ARCHIVOS MARCADOS =====
            if ($request->has('eliminar_archivos')) {
                $idsEliminar = $request->eliminar_archivos;
                $adjuntos = EstudioAdjunto::whereIn('id', $idsEliminar)
                    ->where('historial_clinico_id', $historial->id)
                    ->get();
                
                foreach ($adjuntos as $adjunto) {
                    if (Storage::disk('public')->exists($adjunto->ruta)) {
                        Storage::disk('public')->delete($adjunto->ruta);
                    }
                    $adjunto->delete();
                }
            }
            

// ===== ACTUALIZAR RECETA MÉDICA =====
if ($request->has('generar_receta') && $request->generar_receta == '1') {
    $medicamentos = $request->receta_medicamentos;
    
    if ($medicamentos && count($medicamentos) > 0) {
        $medicamentosValidos = array_filter($medicamentos, function($med) {
            return !empty($med['medicamento']);
        });
        
        if (count($medicamentosValidos) > 0) {
            // Buscar si ya existe una receta para este historial
            $receta = \App\Models\Receta::where('historial_clinico_id', $historial->id)->first();
            
            if (!$receta) {
                $receta = new \App\Models\Receta();
                $receta->historial_clinico_id = $historial->id;
            }
            
            $receta->fecha_emision = $request->receta_fecha_emision ?? now();
            $receta->medicamentos_json = json_encode($medicamentosValidos);
            $receta->medicamento = $medicamentosValidos[0]['medicamento'] ?? null;
            $receta->presentacion = $medicamentosValidos[0]['presentacion'] ?? null;
            $receta->concentracion = $medicamentosValidos[0]['concentracion'] ?? null;
            $receta->dosis = $medicamentosValidos[0]['dosis'] ?? null;
            $receta->frecuencia = $medicamentosValidos[0]['frecuencia'] ?? null;
            $receta->duracion = $medicamentosValidos[0]['duracion'] ?? null;
            $receta->indicaciones = $medicamentosValidos[0]['indicaciones'] ?? null;
            $receta->advertencias = $request->receta_advertencias;
            $receta->signos_alarma = $request->receta_signos_alarma;
            $receta->recomendaciones_no_farmacologicas = $request->receta_recomendaciones_no_farmacologicas;
            $receta->save();
        }
    }
} else {
    // Si no se marcó "generar receta", eliminar la receta asociada
    \App\Models\Receta::where('historial_clinico_id', $historial->id)->delete();
}
            DB::commit();

            $usuario = Auth::user();
            $nombreUsuario = $usuario ? $usuario->name : 'Desconocido';

            Log::info("Historial clínico actualizado", [
                'historial_id' => $historial->id,
                'paciente_id' => $paciente->id,
                'usuario' => $nombreUsuario
            ]);

            return redirect()->route('pacientes.show', $paciente->id)
                ->with('success', 'Historial clínico actualizado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error actualizando historial: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al actualizar el historial: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Paciente $paciente, HistorialClinico $historial)
    {
        try {
            DB::beginTransaction();

            // Eliminar archivos físicos
            $adjuntos = EstudioAdjunto::where('historial_clinico_id', $historial->id)->get();
            foreach ($adjuntos as $adjunto) {
                if (Storage::disk('public')->exists($adjunto->ruta)) {
                    Storage::disk('public')->delete($adjunto->ruta);
                }
            }
            $historial->estudiosAdjuntos()->delete();

            $historial->diagnosticos()->delete();
            $historial->delete();

            DB::commit();

            $usuario = Auth::user();
            $nombreUsuario = $usuario ? $usuario->name : 'Desconocido';

            Log::warning("Historial clínico eliminado", [
                'historial_id' => $historial->id,
                'paciente_id' => $paciente->id,
                'usuario' => $nombreUsuario
            ]);

            return redirect()->route('pacientes.show', $paciente->id)
                ->with('success', 'Historial clínico eliminado correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error eliminando historial: " . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al eliminar el historial: ' . $e->getMessage());
        }
    }

    public function pdf(Paciente $paciente, HistorialClinico $historial)
    {
        $historial->load([
            'diagnosticos', 
            'recetas', 
            'seguimientos', 
            'adjuntos', 
            'estudiosAdjuntos'
        ]);
        
        $pdf = Pdf::loadView('historial.pdf', compact('paciente', 'historial'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->download('Historial_Clinico_' . $historial->id . '_' . $paciente->nombre_completo . '.pdf');
    }

    // ============================================
    // MÉTODOS PARA ARCHIVOS ADJUNTOS
    // ============================================
    
    public function eliminarArchivo($id)
    {
        try {
            $adjunto = EstudioAdjunto::findOrFail($id);
            $historial = $adjunto->historialClinico;
            
            // Eliminar archivo físico
            if (Storage::disk('public')->exists($adjunto->ruta)) {
                Storage::disk('public')->delete($adjunto->ruta);
            }
            
            $adjunto->delete();
            
            return response()->json(['success' => true, 'message' => 'Archivo eliminado']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function descargarArchivo($id)
    {
        try {
            $adjunto = EstudioAdjunto::findOrFail($id);
            
            $rutaCompleta = storage_path('app/public/' . $adjunto->ruta);
            
            if (!file_exists($rutaCompleta)) {
                abort(404, 'Archivo no encontrado');
            }
            
            return response()->download($rutaCompleta, $adjunto->nombre_original);
        } catch (\Exception $e) {
            abort(404, 'Archivo no encontrado');
        }
    }

            /**
         * Obtener el último historial clínico de un paciente (para copiar datos)
         */
        public function ultimoHistorial(Paciente $paciente)
        {
            try {
                $ultimoHistorial = HistorialClinico::where('paciente_id', $paciente->id)
                    ->orderBy('fecha_consulta', 'desc')
                    ->first();
                
                if (!$ultimoHistorial) {
                    return response()->json([
                        'success' => false,
                        'message' => 'El paciente no tiene historiales previos.'
                    ]);
                }
                
                return response()->json([
                    'success' => true,
                    'historial' => $ultimoHistorial
                ]);
                
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al obtener el historial: ' . $e->getMessage()
                ], 500);
            }
        }
}