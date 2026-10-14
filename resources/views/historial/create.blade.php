@extends('layouts.app')

@section('title', 'Nuevo Historial Clínico')
<div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <div>
        <i class="fas fa-notes-medical me-2 text-primary"></i> 
        <span class="fw-semibold">Registrar Nuevo Historial Clínico</span>
        @if($paciente->historialClinicos->count() > 0)
            <span class="badge bg-info ms-2">Historiales previos: {{ $paciente->historialClinicos->count() }}</span>
        @endif
    </div>
    <div>
        @if($paciente->historialClinicos->count() > 0)
            <button type="button" class="btn btn-warning btn-sm" id="btnCopiarHistorialAnterior" title="Copiar datos del último historial">
                <i class="fas fa-copy me-1"></i> Copiar último historial
            </button>
        @endif
    </div>
</div>
@section('page-title', 'Registrar Nuevo Historial Clínico')

@section('content')
<div class="container-fluid px-0">
    <!-- Información del paciente -->
@include('historial.partials._info-paciente')
@include('historial.partials._datos-consulta')
        <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
  @include('historial.partials._antecedentes-patologicos')
        <!-- ========== ANTECEDENTES PERSONALES NO PATOLÓGICOS ========== -->
        @include('historial.partials._antecedentes-no-patologicos')
        <!-- ========== ANTECEDENTES FAMILIARES ========== -->
        @include('historial.partials._antecedentes-familiares')
        <!-- ========== GINECO OBSTÉTRICOS ========== -->
                @include('historial.partials._gineco-obstetricos')
<!-- ========== ENFERMEDAD ACTUAL ========== -->
               @include('historial.partials._enfermedad-actual')
        <!-- ========== SIGNOS VITALES ========== -->
        @include('historial.partials._signos-vitales')
        <!-- ========== EXPLORACIÓN FÍSICA ========== -->
        @include('historial.partials._exploracion-fisica')
        <!-- ========== REVISIÓN DE ÓRGANOS Y SISTEMAS ========== -->
        @include('historial.partials._revision-sistemas')
<!-- ========== ESTUDIOS COMPLEMENTARIOS ========== -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-microscope me-2 text-primary"></i> 
            <span class="fw-semibold">Estudios Complementarios</span>
            <span class="badge bg-info ms-2">Adjunta imágenes y PDFs</span>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="toggleEstudios">
            <i class="fas fa-chevron-up me-1"></i> Contraer
        </button>
    </div>
    <div class="card-body" id="estudiosContainer">
        <!-- ===== LABORATORIO ===== -->
        <div class="row g-2 mb-3">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-flask text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Laboratorio</label>
                                <span class="badge bg-light text-muted" id="count-laboratorio">0 archivos</span>
                            </div>
                            <textarea name="laboratorio" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa los exámenes de laboratorio...">{{ old('laboratorio', $historial->laboratorio ?? '') }}</textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            <!-- Archivos existentes -->
                            @if(isset($historial) && $historial->estudiosAdjuntos->where('categoria', 'Laboratorio')->count() > 0)
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    @foreach($historial->estudiosAdjuntos->where('categoria', 'Laboratorio') as $adjunto)
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-{{ $adjunto->id }}">
                                            <i class="fas {{ $adjunto->icono }} text-{{ $adjunto->color }}" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $adjunto->nombre_original }}</span>
                                            @if(Route::currentRouteName() == 'historial.edit')
                                                <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="{{ $adjunto->id }}" style="font-size: 10px; line-height: 1;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Drop zone -->
                            <div class="drop-zone-laboratorio border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-laboratorio" name="archivos_laboratorio[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx" style="display: none;">
                            </div>
                            <div class="file-list-laboratorio d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== ESTUDIO DE IMAGEN ===== -->
        <div class="row g-2 mb-3">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-x-ray text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Estudio de Imagen</label>
                                <span class="badge bg-light text-muted" id="count-imagen">0 archivos</span>
                            </div>
                            <textarea name="estudio_imagen" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa los estudios de imagen...">{{ old('estudio_imagen', $historial->estudio_imagen ?? '') }}</textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            @if(isset($historial) && $historial->estudiosAdjuntos->where('categoria', 'Imagen')->count() > 0)
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    @foreach($historial->estudiosAdjuntos->where('categoria', 'Imagen') as $adjunto)
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-{{ $adjunto->id }}">
                                            <i class="fas {{ $adjunto->icono }} text-{{ $adjunto->color }}" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $adjunto->nombre_original }}</span>
                                            @if(Route::currentRouteName() == 'historial.edit')
                                                <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="{{ $adjunto->id }}" style="font-size: 10px; line-height: 1;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="drop-zone-imagen border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-imagen" name="archivos_imagen[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" style="display: none;">
                            </div>
                            <div class="file-list-imagen d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== OTROS ===== -->
        <div class="row g-2">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-folder-open text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Otros Estudios</label>
                                <span class="badge bg-light text-muted" id="count-otros">0 archivos</span>
                            </div>
                            <textarea name="otros_exploracion" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa otros estudios complementarios...">{{ old('otros_exploracion', $historial->otros_exploracion ?? '') }}</textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            @if(isset($historial) && $historial->estudiosAdjuntos->where('categoria', 'Otros')->count() > 0)
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    @foreach($historial->estudiosAdjuntos->where('categoria', 'Otros') as $adjunto)
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-{{ $adjunto->id }}">
                                            <i class="fas {{ $adjunto->icono }} text-{{ $adjunto->color }}" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $adjunto->nombre_original }}</span>
                                            @if(Route::currentRouteName() == 'historial.edit')
                                                <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="{{ $adjunto->id }}" style="font-size: 10px; line-height: 1;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="drop-zone-otros border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-otros" name="archivos_otros[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx" style="display: none;">
                            </div>
                            <div class="file-list-otros d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========== DIAGNÓSTICOS ========== -->
<div class="card mb-4 shadow-sm" >
    <div class="card-header bg-white py-3">
        <i class="fas fa-clinic-medical me-2 text-primary"></i> Diagnósticos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="diagnosticos-table">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 35%">Diagnóstico</th>
                        <th style="width: 30%">Código CIE-10</th>
                        <th style="width: 20%">Tipo</th>
                        <th style="width: 10%">Acción</th>
                    </tr>
                </thead>
                <tbody id="diagnosticos-body">
                    <tr class="diagnostico-row">
                        <td class="text-center">1</td>
                        <td>
                            <textarea name="diagnosticos[0][descripcion]" class="form-control diagnostico-text" rows="2" placeholder="Escriba el diagnóstico..." data-index="0"></textarea>
                        </td>
                        <td>
                            <div class="input-group">
                                <input type="text" name="diagnosticos[0][cie10]" id="cie10_0" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" data-index="0">
                                <button type="button" class="btn btn-outline-secondary clear-cie10" data-index="0" title="Limpiar">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- Resultados de búsqueda -->
                            <div id="cie10-results-0" class="cie10-results" style="display: none;"></div>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diagnosticos[0][tipo]" value="PRE" checked>
                                    <label class="form-check-label">PRE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="diagnosticos[0][tipo]" value="DEF">
                                    <label class="form-check-label">DEF</label>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico" disabled>
                                <i class="fas fa-times"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary btn-sm mt-2" id="agregar-diagnostico">
            <i class="fas fa-plus me-1"></i> Agregar Diagnóstico
        </button>
        <small class="text-muted d-block mt-2">PRE = Presuntivo | DEF = Definitivo</small>
    </div>
</div>
        <!-- ========== TRATAMIENTO Y RECOMENDACIONES ========== -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-pills me-2 text-primary"></i> Tratamiento y Recomendaciones
        </div>
        <div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="generarReceta" name="generar_receta" value="1" style="width: 40px; height: 20px;">
                <label class="form-check-label fw-semibold text-success" for="generarReceta">
                    <i class="fas fa-prescription me-1"></i> Generar Receta Médica
                </label>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label fw-semibold">Tratamiento</label>
            <textarea name="tratamiento" id="tratamiento" class="form-control" rows="3" placeholder="Indicaciones médicas, medicamentos, procedimientos..."></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Recomendaciones</label>
            <textarea name="recomendaciones" id="recomendaciones" class="form-control" rows="3" placeholder="Recomendaciones para el paciente..."></textarea>
        </div>

        <!-- ===== RECETA MÉDICA (se muestra solo si se activa) ===== -->
<div id="recetaContainer" style="display: none;">
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="fw-bold text-primary">
            <i class="fas fa-prescription me-2"></i> Datos de la Receta Médica
            <span class="badge bg-info ms-2">Se genera automáticamente desde el tratamiento</span>
        </h6>
        <button type="button" class="btn btn-sm btn-success" id="agregarMedicamento">
            <i class="fas fa-plus me-1"></i> Agregar Medicamento
        </button>
    </div>
    
    <div id="medicamentosContainer" class="mt-3">
        <!-- Fila de medicamento 1 (por defecto) -->
        <div class="medicamento-row border rounded-3 p-3 mb-3" style="background: #f8faff; border-color: #e0e7ff !important;" data-index="0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-semibold text-primary">Medicamento #1</span>
                <button type="button" class="btn btn-sm btn-danger eliminar-medicamento" style="display: none;">
                    <i class="fas fa-times me-1"></i> Eliminar
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                    <input type="text" name="receta_medicamentos[0][medicamento]" class="form-control form-control-sm medicamento-input" placeholder="Ej: Paracetamol">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Presentación</label>
                    <input type="text" name="receta_medicamentos[0][presentacion]" class="form-control form-control-sm" placeholder="Ej: Tabletas">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Concentración</label>
                    <input type="text" name="receta_medicamentos[0][concentracion]" class="form-control form-control-sm" placeholder="Ej: 500mg">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Dosis</label>
                    <input type="text" name="receta_medicamentos[0][dosis]" class="form-control form-control-sm" placeholder="Ej: 1 tableta">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Frecuencia</label>
                    <input type="text" name="receta_medicamentos[0][frecuencia]" class="form-control form-control-sm" placeholder="Ej: Cada 8 horas">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Duración</label>
                    <input type="text" name="receta_medicamentos[0][duracion]" class="form-control form-control-sm" placeholder="Ej: 7 días">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Indicaciones específicas</label>
                    <input type="text" name="receta_medicamentos[0][indicaciones]" class="form-control form-control-sm" placeholder="Instrucciones para este medicamento...">
                </div>
            </div>
        </div>
    </div>

    <!-- Campos generales de la receta -->
    <div class="row g-3 mt-2">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Fecha de Emisión</label>
            <input type="date" name="receta_fecha_emision" id="receta_fecha_emision" class="form-control" value="{{ date('Y-m-d') }}">
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Advertencias</label>
            <textarea name="receta_advertencias" id="receta_advertencias" class="form-control" rows="2" placeholder="Advertencias importantes..."></textarea>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Signos de Alarma</label>
            <textarea name="receta_signos_alarma" id="receta_signos_alarma" class="form-control" rows="2" placeholder="Signos que requieren atención médica inmediata..."></textarea>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Recomendaciones no farmacológicas</label>
            <textarea name="receta_recomendaciones_no_farmacologicas" id="receta_recomendaciones_no_farmacologicas" class="form-control" rows="2" placeholder="Ejercicio, dieta, hidratación..."></textarea>
        </div>
    </div>
</div>

        <!-- ========== OBSERVACIONES ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-comment me-2 text-primary"></i> Observaciones
            </div>
            <div class="card-body">
                <textarea name="observaciones" class="form-control" rows="2" placeholder="Observaciones adicionales..."></textarea>
            </div>
        </div>

        <!-- BOTONES -->
        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('pacientes.show', $paciente) }}" class="btn btn-secondary px-4 py-2">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary px-5 py-2">
                <i class="fas fa-save me-2"></i> Guardar Historial
            </button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<style>
/* ============================================
   🩺 CIE-10 RESULTADOS - MEJORADO
   ============================================ */

/* 📦 Contenedor de resultados */
.cie10-results {
    background: white !important;
    border: 1px solid #ccc !important;
    border-radius: 10px !important;
    max-height: 150px !important;
    overflow-y: auto !important;
    z-index: 999999 !important;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15) !important;
    margin-top: 4px !important;
    position: absolute !important;
    width: 100% !important;
    min-width: 250px !important;
    left: 0 !important;
    top: 100% !important;
    padding: 4px 0 !important;
}

/* 📋 Items de resultados */
.cie10-results-item {
    padding: 8px 14px !important;
    cursor: pointer !important;
    border-bottom: 1px solid #f0f0f0 !important;
    font-size: 13px !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    transition: all 0.15s ease !important;
}

.cie10-results-item:last-child {
    border-bottom: none !important;
}

.cie10-results-item:hover {
    background: #e3f2fd !important;
}

.cie10-results-item .cie10-code {
    font-weight: 700 !important;
    color: #0d47a1 !important;
    background: #e3f2fd !important;
    padding: 3px 12px !important;
    border-radius: 4px !important;
    font-size: 12px !important;
    min-width: 60px !important;
    text-align: center !important;
    flex-shrink: 0 !important;
}

.cie10-results-item:hover .cie10-code {
    background: #0d47a1 !important;
    color: white !important;
}

.cie10-results-item .cie10-desc {
    flex: 1 !important;
    color: #1a1a1a !important;
    margin-left: 12px !important;
}

.cie10-results-item:hover .cie10-desc {
    color: #0d47a1 !important;
}

/* 🎯 Item seleccionado */
.cie10-results-item.selected {
    background: #0d47a1 !important;
    color: white !important;
}

.cie10-results-item.selected .cie10-code {
    background: white !important;
    color: #0d47a1 !important;
}

.cie10-results-item.selected .cie10-desc {
    color: white !important;
}

/* 📦 Asegurar que la celda contenga los resultados */
#diagnosticos-table td:nth-child(3) {
   
    position: relative !important;
    overflow: visible !important;
    min-width: 200px !important;
}

/* 📋 Asegurar que la tabla no corte */
#diagnosticos-table {
    overflow: visible !important;
}

.table-responsive {
    overflow: visible !important;
    padding-bottom: 75px !important;
}

.card-body {
    overflow: visible !important;
}

/* 🔄 Scroll personalizado */
.cie10-results::-webkit-scrollbar {
    width: 5px !important;
}

.cie10-results::-webkit-scrollbar-track {
    background: #f1f1f1 !important;
    border-radius: 4px !important;
}

.cie10-results::-webkit-scrollbar-thumb {
    background: #ccc !important;
    border-radius: 4px !important;
}

.cie10-results::-webkit-scrollbar-thumb:hover {
    background: #aaa !important;
}
.diagnostico-text {
    min-height: 50px !important;
    height: 50px !important;
    resize: vertical !important;
    font-size: 14px !important;
    padding: 8px 10px !important;
    line-height: 1.5 !important;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // 🌐 CONFIGURACIÓN DE RUTAS
    // ============================================
    const cie10SearchUrl = '{{ route("cie10.search") }}';
    const cie10ByDiagnosticoUrl = '{{ route("cie10.by-diagnostico") }}';

    // ============================================
    // 🔧 FUNCIÓN PRINCIPAL - CONFIGURAR FILA
    // ============================================
    function configurarFila(row) {
        const cie10Input = row.querySelector('.cie10-input');
        const diagnosticoText = row.querySelector('.diagnostico-text');
        const clearBtn = row.querySelector('.clear-cie10');

        if (!cie10Input) return;

        const index = cie10Input.dataset.index;
        const resultsContainerId = 'cie10-results-' + index;
        let resultsContainer = document.getElementById(resultsContainerId);
        
        // 📦 Crear contenedor si no existe
        if (!resultsContainer) {
            resultsContainer = document.createElement('div');
            resultsContainer.id = resultsContainerId;
            resultsContainer.className = 'cie10-results';
            resultsContainer.style.display = 'none';
            const td = row.querySelector('td:nth-child(3)');
            td.style.position = 'relative';
            td.appendChild(resultsContainer);
            
        }

        let searchTimeout;
        let selectedIndex = -1;
        let currentResults = [];

        // ============================================
        // 🔍 FUNCIÓN DE BÚSQUEDA
        // ============================================
        function buscar(term) {
            if (term.length < 1) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                currentResults = [];
                selectedIndex = -1;
                return;
            }

            const cleanTerm = term; // NO eliminar el punto - permite búsqueda con punto

            // 🔄 Mostrar indicador de carga
            resultsContainer.style.display = 'block';
            resultsContainer.innerHTML = '<div class="cie10-loading"><i class="fas fa-spinner fa-spin"></i> Buscando...</div>';

            fetch(cie10SearchUrl + '?q=' + encodeURIComponent(cleanTerm))
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';
                    currentResults = data;
                    selectedIndex = -1;
                    
                    if (data.length > 0) {
                        resultsContainer.style.display = 'block';
                        data.forEach((item, idx) => {
                            const div = document.createElement('div');
                            div.className = 'cie10-results-item';
                            div.innerHTML = `
                                <span class="cie10-code">${item.codigo}</span>
                                <span class="cie10-desc">${item.diagnostico}</span>
                            `;
                            div.dataset.codigo = item.codigo;
                            div.dataset.diagnostico = item.diagnostico;
                            div.dataset.index = idx;
                            
                            // 🖱️ Click para seleccionar
                            div.addEventListener('click', function(e) {
                                e.stopPropagation();
                                const codigo = this.dataset.codigo;
                                const diagnostico = this.dataset.diagnostico;
                                
                                cie10Input.value = codigo;
                                if (diagnosticoText) {
                                    diagnosticoText.value = diagnostico;
                                }
                                
                                resultsContainer.style.display = 'none';
                                resultsContainer.innerHTML = '';
                                currentResults = [];
                                selectedIndex = -1;
                                cie10Input.focus();
                                cie10Input.dispatchEvent(new Event('change'));
                            });
                            
                            // 🎯 Hover
                            div.addEventListener('mouseenter', function() {
                                document.querySelectorAll('.cie10-results-item').forEach(el => {
                                    el.classList.remove('selected');
                                });
                                this.classList.add('selected');
                                selectedIndex = parseInt(this.dataset.index);
                            });
                            
                            resultsContainer.appendChild(div);
                        });
                    } else {
                        resultsContainer.innerHTML = '<div class="cie10-no-results">No se encontraron resultados</div>';
                        resultsContainer.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsContainer.style.display = 'none';
                    resultsContainer.innerHTML = '';
                });
        }

        // ============================================
        // ⌨️ EVENTO: ESCRIBIR EN CÓDIGO CIE-10
        // ============================================
        cie10Input.addEventListener('input', function() {
            const term = this.value.trim();
            clearTimeout(searchTimeout);
            
            searchTimeout = setTimeout(function() {
                buscar(term);
            }, 200);
        });

        // ============================================
        // 📝 EVENTO: ESCRIBIR EN DIAGNÓSTICO
        // (BUSCA TODAS LAS OPCIONES)
        // ============================================
        if (diagnosticoText) {
            let diagnosticoTimeout;
            
            diagnosticoText.addEventListener('input', function() {
                const term = this.value.trim();
                clearTimeout(diagnosticoTimeout);
                
                if (term.length < 1) {
                    resultsContainer.style.display = 'none';
                    resultsContainer.innerHTML = '';
                    return;
                }

                diagnosticoTimeout = setTimeout(function() {
                    // 🔥 Usar búsqueda general para obtener TODAS las opciones
                    fetch(cie10SearchUrl + '?q=' + encodeURIComponent(term))
                        .then(response => response.json())
                        .then(data => {
                            resultsContainer.innerHTML = '';
                            
                            if (data.length > 0) {
                                resultsContainer.style.display = 'block';
                                data.forEach((item, idx) => {
                                    const div = document.createElement('div');
                                    div.className = 'cie10-results-item';
                                    div.innerHTML = `
                                        <span class="cie10-code">${item.codigo}</span>
                                        <span class="cie10-desc">${item.diagnostico}</span>
                                    `;
                                    div.dataset.codigo = item.codigo;
                                    div.dataset.diagnostico = item.diagnostico;
                                    div.dataset.index = idx;
                                    
                                    div.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                        const codigo = this.dataset.codigo;
                                        const diagnostico = this.dataset.diagnostico;
                                        
                                        cie10Input.value = codigo;
                                        diagnosticoText.value = diagnostico;
                                        
                                        resultsContainer.style.display = 'none';
                                        resultsContainer.innerHTML = '';
                                        cie10Input.focus();
                                        cie10Input.dispatchEvent(new Event('change'));
                                    });
                                    
                                    div.addEventListener('mouseenter', function() {
                                        document.querySelectorAll('.cie10-results-item').forEach(el => {
                                            el.classList.remove('selected');
                                        });
                                        this.classList.add('selected');
                                    });
                                    
                                    resultsContainer.appendChild(div);
                                });
                            } else {
                                resultsContainer.innerHTML = '<div class="cie10-no-results">No se encontraron resultados</div>';
                                resultsContainer.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            resultsContainer.style.display = 'none';
                            resultsContainer.innerHTML = '';
                        });
                }, 300);
            });
        }

        // ============================================
        // ⬆️⬇️ TECLAS DE NAVEGACIÓN
        // ============================================
        cie10Input.addEventListener('keydown', function(e) {
            const items = resultsContainer.querySelectorAll('.cie10-results-item');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (items.length === 0) return;
                
                items.forEach(el => el.classList.remove('selected'));
                selectedIndex = (selectedIndex + 1) % items.length;
                items[selectedIndex].classList.add('selected');
                items[selectedIndex].scrollIntoView({ block: 'nearest' });
                
                const codigo = items[selectedIndex].dataset.codigo;
                const diagnostico = items[selectedIndex].dataset.diagnostico;
                cie10Input.value = codigo;
                if (diagnosticoText) {
                    diagnosticoText.value = diagnostico;
                }
            }
            
            if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (items.length === 0) return;
                
                items.forEach(el => el.classList.remove('selected'));
                selectedIndex = (selectedIndex - 1 + items.length) % items.length;
                items[selectedIndex].classList.add('selected');
                items[selectedIndex].scrollIntoView({ block: 'nearest' });
                
                const codigo = items[selectedIndex].dataset.codigo;
                const diagnostico = items[selectedIndex].dataset.diagnostico;
                cie10Input.value = codigo;
                if (diagnosticoText) {
                    diagnosticoText.value = diagnostico;
                }
            }
            
            if (e.key === 'Enter') {
                e.preventDefault();
                if (items.length > 0 && selectedIndex >= 0) {
                    const selected = items[selectedIndex];
                    const codigo = selected.dataset.codigo;
                    const diagnostico = selected.dataset.diagnostico;
                    
                    cie10Input.value = codigo;
                    if (diagnosticoText) {
                        diagnosticoText.value = diagnostico;
                    }
                    
                    resultsContainer.style.display = 'none';
                    resultsContainer.innerHTML = '';
                    currentResults = [];
                    selectedIndex = -1;
                    cie10Input.focus();
                }
            }
            
            if (e.key === 'Escape') {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                currentResults = [];
                selectedIndex = -1;
            }
        });

        // ============================================
        // 👋 OCULTAR RESULTADOS AL PERDER FOCO
        // ============================================
        cie10Input.addEventListener('blur', function() {
            setTimeout(function() {
                resultsContainer.style.display = 'none';
            }, 300);
        });

        // ============================================
        // 🧹 BOTÓN LIMPIAR
        // ============================================
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                cie10Input.value = '';
                if (diagnosticoText) {
                    diagnosticoText.value = '';
                }
                resultsContainer.innerHTML = '';
                resultsContainer.style.display = 'none';
                currentResults = [];
                selectedIndex = -1;
                cie10Input.focus();
            });
        }

        // ============================================
        // 🖱️ CLICK FUERA PARA CERRAR
        // ============================================
        document.addEventListener('click', function(e) {
            if (!row.contains(e.target)) {
                resultsContainer.style.display = 'none';
            }
        });
    }

    // ============================================
    // ⚙️ CONFIGURAR FILAS EXISTENTES
    // ============================================
    document.querySelectorAll('.diagnostico-row').forEach(function(row) {
        configurarFila(row);
    });

    // ============================================
    // ➕ AGREGAR NUEVA FILA
    // ============================================
    document.getElementById('agregar-diagnostico').addEventListener('click', function() {
        const tbody = document.getElementById('diagnosticos-body');
        const rowCount = tbody.querySelectorAll('.diagnostico-row').length;
        const newIndex = rowCount;
        
        const tr = document.createElement('tr');
        tr.className = 'diagnostico-row';
        tr.innerHTML = `
            <td class="text-center">${rowCount + 1}</td>
            <td>
                <textarea name="diagnosticos[${newIndex}][descripcion]" class="form-control diagnostico-text" rows="1" placeholder="Escriba el diagnóstico..." data-index="${newIndex}"></textarea>
            </td>
            <td style="position: relative; overflow: visible;">
                <div class="input-group">
                    <input type="text" name="diagnosticos[${newIndex}][cie10]" id="cie10_${newIndex}" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" data-index="${newIndex}">
                    <button type="button" class="btn btn-outline-secondary clear-cie10" data-index="${newIndex}" title="Limpiar">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="cie10-results-${newIndex}" class="cie10-results" style="display: none;"></div>
            </td>
            <td>
                <div class="d-flex gap-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnosticos[${newIndex}][tipo]" value="PRE" checked>
                        <label class="form-check-label">PRE</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnosticos[${newIndex}][tipo]" value="DEF">
                        <label class="form-check-label">DEF</label>
                    </div>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
        
        tbody.appendChild(tr);
        configurarFila(tr);
        actualizarBotonesEliminar();
        actualizarNumeros();
    });

    // ============================================
    // 🗑️ ACTUALIZAR BOTONES ELIMINAR
    // ============================================
    function actualizarBotonesEliminar() {
        const rows = document.querySelectorAll('.diagnostico-row');
        const buttons = document.querySelectorAll('.eliminar-diagnostico');
        
        buttons.forEach((btn) => {
            if (rows.length <= 1) {
                btn.disabled = true;
            } else {
                btn.disabled = false;
            }
        });
    }

    // ============================================
    // 🔢 ACTUALIZAR NÚMEROS DE FILAS
    // ============================================
    function actualizarNumeros() {
        document.querySelectorAll('.diagnostico-row').forEach((row, index) => {
            row.querySelector('td:first-child').textContent = index + 1;
        });
    }

    // ============================================
    // 🗑️ ELIMINAR FILA AL HACER CLICK
    // ============================================
    document.getElementById('diagnosticos-body').addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-diagnostico')) {
            const btn = e.target.closest('.eliminar-diagnostico');
            const row = btn.closest('.diagnostico-row');
            if (document.querySelectorAll('.diagnostico-row').length > 1) {
                row.remove();
                actualizarNumeros();
                actualizarBotonesEliminar();
            }
        }
    });

    actualizarBotonesEliminar();
});
// ============================================
// CONFIGURAR DROP ZONES (VERSIÓN MEJORADA)
// ============================================
function configurarDropZoneCompact(zoneClass, inputClass, listClass, countClass, categoria) {
    const dropZone = document.querySelector(zoneClass);
    const fileInput = document.querySelector(inputClass);
    const fileList = document.querySelector(listClass);
    const countBadge = document.getElementById(countClass);
    let archivos = [];

    if (!dropZone || !fileInput) return;

    dropZone.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.click();
    });

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#4f46e5';
        this.style.background = '#eef2ff';
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#d1d5db';
        this.style.background = '#fafafa';
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#d1d5db';
        this.style.background = '#fafafa';
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            agregarArchivosCompact(files, archivos, fileList, countBadge, categoria);
        }
    });

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            agregarArchivosCompact(this.files, archivos, fileList, countBadge, categoria);
        }
        this.value = '';
    });

    // Actualizar contador inicial
    if (countBadge) {
        const existingFiles = fileList.querySelectorAll('.border').length;
        countBadge.textContent = existingFiles + ' archivos';
    }

    return {
        getArchivos: function() { return archivos; },
        limpiar: function() { archivos = []; fileList.innerHTML = ''; if (countBadge) countBadge.textContent = '0 archivos'; }
    };
}

function agregarArchivosCompact(files, archivosArray, fileList, countBadge, categoria) {
    const maxSize = 10 * 1024 * 1024;

    for (let file of files) {
        if (file.size > maxSize) {
            mostrarAlertaCompact(`❌ ${file.name} excede 10MB`, 'danger');
            continue;
        }
        const existe = archivosArray.some(a => a.name === file.name && a.size === file.size);
        if (!existe) {
            archivosArray.push(file);
        }
    }
    renderizarArchivosCompact(archivosArray, fileList, countBadge, categoria);
}

function renderizarArchivosCompact(archivosArray, fileList, countBadge, categoria) {
    if (archivosArray.length === 0) {
        fileList.innerHTML = '';
        if (countBadge) countBadge.textContent = '0 archivos';
        return;
    }

    let html = '';
    archivosArray.forEach((file, index) => {
        const icono = getIconoArchivo(file.type);
        const color = getColorArchivo(file.type);
        const tamaño = file.size > 1048576 ? (file.size / 1048576).toFixed(1) + 'MB' : (file.size / 1024).toFixed(0) + 'KB';
        html += `
            <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;">
                <i class="fas ${icono} text-${color}" style="font-size: 12px;"></i>
                <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                <span class="text-muted" style="font-size: 9px;">${tamaño}</span>
                <button type="button" class="btn btn-sm btn-danger p-0 px-1" onclick="this.closest('.border').remove()" style="font-size: 10px; line-height: 1;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
    });

    fileList.innerHTML = html;
    if (countBadge) countBadge.textContent = archivosArray.length + ' archivos';
}

// ============================================
// INICIALIZAR DROP ZONES
// ============================================
configurarDropZoneCompact('.drop-zone-laboratorio', '.file-input-laboratorio', '.file-list-laboratorio', 'count-laboratorio', 'laboratorio');
configurarDropZoneCompact('.drop-zone-imagen', '.file-input-imagen', '.file-list-imagen', 'count-imagen', 'imagen');
configurarDropZoneCompact('.drop-zone-otros', '.file-input-otros', '.file-list-otros', 'count-otros', 'otros');

// ============================================
// TOGGLE CONTRAER/EXPANDIR
// ============================================
document.getElementById('toggleEstudios')?.addEventListener('click', function() {
    const container = document.getElementById('estudiosContainer');
    const icon = this.querySelector('i');
    if (container.style.display === 'none') {
        container.style.display = 'block';
        icon.className = 'fas fa-chevron-up me-1';
        this.innerHTML = '<i class="fas fa-chevron-up me-1"></i> Contraer';
    } else {
        container.style.display = 'none';
        icon.className = 'fas fa-chevron-down me-1';
        this.innerHTML = '<i class="fas fa-chevron-down me-1"></i> Expandir';
    }
});

// ============================================
// FUNCIONES AUXILIARES
// ============================================
function getIconoArchivo(mimeType) {
    const iconos = {
        'image/jpeg': 'fa-file-image', 'image/png': 'fa-file-image', 'image/gif': 'fa-file-image',
        'image/webp': 'fa-file-image', 'application/pdf': 'fa-file-pdf',
        'application/msword': 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'fa-file-word',
        'application/vnd.ms-excel': 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'fa-file-excel',
    };
    return iconos[mimeType] || 'fa-file';
}

function getColorArchivo(mimeType) {
    const colores = {
        'image/jpeg': 'primary', 'image/png': 'primary', 'image/gif': 'primary',
        'image/webp': 'primary', 'application/pdf': 'danger',
        'application/msword': 'info',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'info',
        'application/vnd.ms-excel': 'success',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'success',
    };
    return colores[mimeType] || 'secondary';
}

function mostrarAlertaCompact(mensaje, tipo = 'danger') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show py-1 px-2 mb-1`;
    alerta.role = 'alert';
    alerta.style.fontSize = '12px';
    alerta.innerHTML = `${mensaje} <button type="button" class="btn-close p-1" data-bs-dismiss="alert" style="font-size: 10px;"></button>`;
    const container = document.querySelector('#estudiosContainer');
    if (container) {
        container.prepend(alerta);
        setTimeout(() => alerta.remove(), 4000);
    }
}
// ============================================
// TOGGLE PARA SISTEMAS
// ============================================
document.querySelectorAll('.sistema-toggle').forEach(function(checkbox) {
    const targetId = checkbox.dataset.target;
    const textarea = document.getElementById(targetId);
    
    // Verificar estado inicial (para edit)
    if (checkbox.checked && textarea) {
        textarea.style.display = 'block';
    }
    
    checkbox.addEventListener('change', function() {
        if (textarea) {
            if (this.checked) {
                textarea.style.display = 'block';
                textarea.focus();
            } else {
                textarea.style.display = 'none';
                textarea.value = '';
            }
        }
    });
});
// ============================================
// TOGGLE PARA SISTEMAS - SP / CP
// ============================================
document.querySelectorAll('.sistema-radio').forEach(function(radio) {
    const targetId = radio.dataset.target;
    const textarea = document.getElementById(targetId);
    
    radio.addEventListener('change', function() {
        if (textarea) {
            if (this.value === 'CP' && this.checked) {
                textarea.style.display = 'block';
                textarea.focus();
            } else if (this.value === 'SP' && this.checked) {
                textarea.style.display = 'none';
                textarea.value = '';
            }
        }
    });

    // Verificar estado inicial (si hay CP seleccionado por defecto desde edit)
    if (radio.value === 'CP' && radio.checked && textarea) {
        textarea.style.display = 'block';
    }
});

// ============================================
// TOGGLE CONTRAER/EXPANDIR
// ============================================
document.getElementById('toggleSistemas')?.addEventListener('click', function() {
    const container = document.getElementById('sistemasContainer');
    const icon = this.querySelector('i');
    if (container.style.display === 'none') {
        container.style.display = 'block';
        icon.className = 'fas fa-chevron-up me-1';
        this.innerHTML = '<i class="fas fa-chevron-up me-1"></i> Contraer';
    } else {
        container.style.display = 'none';
        icon.className = 'fas fa-chevron-down me-1';
        this.innerHTML = '<i class="fas fa-chevron-down me-1"></i> Expandir';
    }
});
//------------------------------------------------
// ============================================
// CALCULAR IMC
// ============================================
function calcularIMC() {
    const peso = parseFloat(document.getElementById('peso')?.value);
    const altura = parseFloat(document.getElementById('altura')?.value);
    const imcInput = document.getElementById('masa_corporal');
    
    if (peso && altura && altura > 0 && imcInput) {
        const imc = peso / (altura * altura);
        imcInput.value = imc.toFixed(2);
    } else if (imcInput) {
        imcInput.value = '';
    }
}

// ============================================
// COPIAR DATOS DEL ÚLTIMO HISTORIAL
// ============================================
document.getElementById('btnCopiarHistorialAnterior')?.addEventListener('click', function() {
    const pacienteId = {{ $paciente->id }};
    const url = '{{ route("pacientes.ultimo-historial", $paciente->id) }}';
    
    this.disabled = true;
    this.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Cargando...';
    
    fetch(url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP Error: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success && data.historial) {
            const historial = data.historial;
            
            // - Campos de texto -
            const camposTexto = [
                'hospitalizaciones', 'cardiovasculares', 'pulmonales', 'digestivos', 
                'diabetes', 'renales', 'quirurgicos', 'transfusiones', 
                'alergias_patologicas', 'otros_patologicos',
                'alcohol', 'tabaquismo', 'drogas', 'inmunizaciones', 'otros_no_patologicos',
                'menarquia', 'ritmo', 'fmu', 'gestas', 'partos', 'abortos', 
                'cesareas', 'hijos_vivos', 'num_parejas_sexuales', 'menopausia',
                'cuales_anticonceptivos', 'alergias', 'observaciones',
                'observaciones_sistemas', 'antecedentes_familiares'
            ];
            
            camposTexto.forEach(function(campo) {
                const elemento = document.querySelector(`[name="${campo}"]`);
                if (elemento) {
                    elemento.value = historial[campo] || '';
                }
            });
            
            // - Peso y Altura -
            const pesoInput = document.querySelector('[name="peso"]');
            const alturaInput = document.querySelector('[name="altura"]');
            
            if (pesoInput) pesoInput.value = historial.peso || '';
            if (alturaInput) alturaInput.value = historial.altura || '';
            
            // ===== RECALCULAR IMC =====
            if (typeof calcularIMC === 'function') {
                calcularIMC();
            }
            
            // - Antecedentes Familiares (checkboxes) -
            const familiares = [
                'familiar_hipertension', 'familiar_diabetes', 'familiar_cardiopatias',
                'familiar_cancer', 'familiar_obesidad', 'familiar_dislipidemia',
                'familiar_enfermedad_renal', 'familiar_enfermedad_tiroidea',
                'familiar_enfermedad_mental', 'familiar_tuberculosis',
                'familiar_alcoholismo', 'familiar_otras'
            ];
            familiares.forEach(function(campo) {
                const checkbox = document.querySelector(`[name="${campo}"]`);
                if (checkbox) {
                    checkbox.checked = historial[campo] == 1 || historial[campo] === true;
                }
            });
            
            // Checkbox "No refiere"
            const noRefiere = document.querySelector('[name="familiares_no_refiere"]');
            if (noRefiere) noRefiere.checked = historial.familiares_no_refiere == 1 || historial.familiares_no_refiere === true;
            
            // - Anticonceptivos -
            const usaAnticonceptivos = document.querySelector(`[name="usa_anticonceptivos"][value="${historial.usa_anticonceptivos ? '1' : '0'}"]`);
            if (usaAnticonceptivos) usaAnticonceptivos.checked = true;
            
            // - Revisión de Sistemas (SP/CP) -
            const sistemas = [
                'cardiovascular', 'respiratorio', 'digestivo', 'renal', 'neurologico',
                'musculoesqueletico', 'endocrino', 'hematologico', 'linfatico',
                'genitourinario', 'piel', 'oftalmologico', 'orl', 'psiquiatrico'
            ];
            sistemas.forEach(function(sistema) {
                const campo = `sist_${sistema}`;
                const valor = historial[campo] || 'SP';
                const radio = document.querySelector(`[name="${campo}"][value="${valor}"]`);
                if (radio) {
                    radio.checked = true;
                    radio.dispatchEvent(new Event('change'));
                }
                
                const obsCampo = `${campo}_obs`;
                const obsTextarea = document.querySelector(`[name="${obsCampo}"]`);
                if (obsTextarea) {
                    obsTextarea.value = historial[obsCampo] || '';
                }
            });
            
            mostrarAlertaHistorial('✅ Datos del último historial copiados exitosamente.', 'success');
            
        } else {
            mostrarAlertaHistorial(data.message || '❌ No se encontró un historial previo.', 'warning');
        }
    })
    .catch(error => {
        console.error('❌ Error:', error);
        mostrarAlertaHistorial('❌ Error al copiar los datos: ' + error.message, 'danger');
    })
    .finally(() => {
        this.disabled = false;
        this.innerHTML = '<i class="fas fa-copy me-1"></i> Copiar último historial';
    });
});

function mostrarAlertaHistorial(mensaje, tipo = 'success') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.role = 'alert';
    alerta.innerHTML = `${mensaje} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
    const container = document.querySelector('.card-body');
    if (container) {
        container.prepend(alerta);
        setTimeout(() => alerta.remove(), 5000);
    }
}
//--------------------------------------------------
// ============================================
// GENERAR RECETA MÉDICA - SINCRONIZACIÓN BIDIRECCIONAL
// ============================================
const generarRecetaCheckbox = document.getElementById('generarReceta');
const recetaContainer = document.getElementById('recetaContainer');
const tratamientoInput = document.getElementById('tratamiento');
const recomendacionesInput = document.getElementById('recomendaciones');

// Campos de la receta
const recetaCampos = {
    medicamento: document.getElementById('receta_medicamento'),
    presentacion: document.getElementById('receta_presentacion'),
    dosis: document.getElementById('receta_dosis'),
    frecuencia: document.getElementById('receta_frecuencia'),
    duracion: document.getElementById('receta_duracion'),
    indicaciones: document.getElementById('receta_indicaciones')
};

// Guardar los valores originales para detectar cambios manuales
let valoresOriginales = {};

function guardarValoresOriginales() {
    Object.keys(recetaCampos).forEach(key => {
        const campo = recetaCampos[key];
        if (campo) {
            valoresOriginales[key] = campo.value;
        }
    });
}

function tieneCambiosManuales() {
    let tieneCambios = false;
    Object.keys(recetaCampos).forEach(key => {
        const campo = recetaCampos[key];
        if (campo && campo.value !== valoresOriginales[key]) {
            tieneCambios = true;
        }
    });
    return tieneCambios;
}

// ===== TOGGLE MOSTRAR/OCULTAR RECETA =====
generarRecetaCheckbox?.addEventListener('change', function() {
    if (this.checked) {
        recetaContainer.style.display = 'block';
        // Guardar valores originales antes de autocompletar
        guardarValoresOriginales();
        autocompletarReceta();
        // Scroll suave hacia la receta
        setTimeout(() => {
            recetaContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    } else {
        recetaContainer.style.display = 'none';
    }
});

// ===== AUTOCOMPLETAR RECETA DESDE TRATAMIENTO =====
function autocompletarReceta(force = false) {
    if (!generarRecetaCheckbox?.checked) return;
    
    // Si el usuario ha hecho cambios manuales y no se fuerza, no sobrescribir
    if (!force && tieneCambiosManuales()) {
        return;
    }
    
    const tratamiento = tratamientoInput?.value || '';
    const recomendaciones = recomendacionesInput?.value || '';
    
    if (!tratamiento) return;
    
    // Extraer medicamentos del tratamiento
    const medicamentos = extraerMedicamentos(tratamiento);
    
    console.log('🔍 Medicamentos extraídos:', medicamentos); // Para depuración
    
    // Si hay medicamentos, llenar los campos
    if (medicamentos.length > 0) {
        const primerMedicamento = medicamentos[0];
        
        // Medicamento
        if (recetaCampos.medicamento && (!recetaCampos.medicamento.value || force)) {
            recetaCampos.medicamento.value = primerMedicamento.nombre || '';
        }
        
        // Presentación
        if (recetaCampos.presentacion && (!recetaCampos.presentacion.value || force)) {
            recetaCampos.presentacion.value = primerMedicamento.presentacion || '';
        }
        
        // Dosis
        if (recetaCampos.dosis && (!recetaCampos.dosis.value || force)) {
            recetaCampos.dosis.value = primerMedicamento.dosis || '';
        }
        
        // Frecuencia
        if (recetaCampos.frecuencia && (!recetaCampos.frecuencia.value || force)) {
            recetaCampos.frecuencia.value = primerMedicamento.frecuencia || '';
        }
        
        // Duración
        if (recetaCampos.duracion && (!recetaCampos.duracion.value || force)) {
            recetaCampos.duracion.value = primerMedicamento.duracion || '';
        }
    }
    
    // Si hay recomendaciones y el campo de indicaciones está vacío
    if (recetaCampos.indicaciones && !recetaCampos.indicaciones.value && recomendaciones) {
        recetaCampos.indicaciones.value = recomendaciones;
    }
    
    // Guardar nuevos valores originales después del autocompletado
    setTimeout(guardarValoresOriginales, 100);
}

// ============================================
// EXTRAER MEDICAMENTOS - VERSIÓN MEJORADA
// ============================================
function extraerMedicamentos(texto) {
    const medicamentos = [];
    
    if (!texto) return medicamentos;
    
    // Lista ampliada de medicamentos comunes (incluyendo variantes)
    const medicamentosConocidos = [
        // AINES y analgésicos
        'paracetamol', 'acetaminofen', 'ibuprofeno', 'aspirina', 'acido acetilsalicilico',
        'diclofenaco', 'naproxeno', 'ketorolaco', 'indometacina', 'piroxicam',
        'meloxicam', 'celecoxib', 'etoricoxib', 'metamizol', 'dipirona',
        
        // Antibióticos
        'amoxicilina', 'azitromicina', 'claritromicina', 'eritromicina', 'ciprofloxacino',
        'levofloxacino', 'moxifloxacino', 'doxiciclina', 'minociclina', 'metronidazol',
        'cefalexina', 'cefuroxima', 'ceftriaxona', 'cefotaxima', 'penicilina',
        
        // Cardiovasculares
        'enalapril', 'losartan', 'valsartan', 'irbesartan', 'candesartan',
        'amlodipino', 'nifedipino', 'felodipino', 'lercanidipino', 'atenolol',
        'propranolol', 'metoprolol', 'bisoprolol', 'carvedilol', 'simvastatina',
        'atorvastatina', 'rosuvastatina', 'pravastatina', 'clopidogrel', 'aspirina',
        'digoxina', 'nitroglicerina', 'furosemida', 'torasemida', 'hidroclorotiazida',
        'espironolactona', 'amilorida', 'dobutamina', 'dopamina', 'noradrenalina',
        
        // Antidiabéticos
        'metformina', 'glibenclamida', 'glipizida', 'gliclazida', 'pioglitazona',
        'rosiglitazona', 'insulina', 'liraglutida', 'semaglutida', 'dulaglutida',
        'empagliflozina', 'dapagliflozina', 'canagliflozina', 'sitagliptina', 'linagliptina',
        
        // Gastrointestinales
        'omeprazol', 'pantoprazol', 'esomeprazol', 'lansoprazol', 'rabeprazol',
        'ranitidina', 'famotidina', 'nizatidina', 'metoclopramida', 'domperidona',
        'ondansetron', 'granisetron', 'palonosetron', 'alosetron', 'ramosetron',
        
        // Broncodilatadores y respiratorios
        'salbutamol', 'albuterol', 'salmeterol', 'formoterol', 'budesonida',
        'fluticasona', 'budesonida', 'montelukast', 'zafirlukast', 'teofilina',
        'aminofilina', 'ipratropio', 'tiotropio', 'umaClidinio', 'bromuro de ipratropio',
        
        // Corticoides
        'prednisona', 'prednisolona', 'metilprednisolona', 'dexametasona', 'hidrocortisona',
        'betametasona', 'fludrocortisona', 'cortisona', 'triamcinolona', 'mometasona',
        
        // Neurológicos y psiquiátricos
        'fenitoina', 'carbamazepina', 'valproato', 'lamotrigina', 'levetiracetam',
        'escitalopram', 'sertralina', 'fluoxetina', 'paroxetina', 'venlafaxina',
        'duloxetina', 'bupropion', 'mirtazapina', 'trazodona', 'aripiprazol',
        'risperidona', 'olanzapina', 'quetiapina', 'clozapina', 'haloperidol',
        'clonazepam', 'alprazolam', 'diazepam', 'lorazepam', 'bromazepam',
        'zolpidem', 'zopiclona', 'melatonina', 'doxilamina', 'hidroxizina',
        
        // Tiroideos
        'levotiroxina', 'liotironina', 'carbimazol', 'propiltiouracilo', 'metimazol',
        
        // Anticoagulantes
        'heparina', 'enoxaparina', 'warfarin', 'acenocumarol', 'rivaroxaban',
        'apixaban', 'dabigatran', 'edoxaban', 'fondaparinux',
        
        // Vitaminas y minerales
        'vitamina d', 'vitamina b12', 'vitamina c', 'vitamina e', 'vitamina a',
        'hierro', 'sulfato ferroso', 'gluconato de zinc', 'calcio', 'magnesio',
        'potasio', 'cloruro de potasio', 'fosfato', 'magnesio', 'calcio',
        
        // Otros comunes
        'colchicina', 'alopurinol', 'febuxostat', 'levodopa', 'carbidopa',
        'bromocriptina', 'cabergolina', 'pramipexol', 'ropinirol', 'apomorfina'
    ];
    
    const textoLower = texto.toLowerCase();
    
    // ===== 1. BUSCAR MEDICAMENTOS CONOCIDOS =====
    medicamentosConocidos.forEach(nombre => {
        if (textoLower.includes(nombre.toLowerCase())) {
            // Buscar dosis
            const dosisMatch = texto.match(/\b(\d+)\s*(mg|g|ml|mcg|ug|UI)\b/i);
            const dosis = dosisMatch ? dosisMatch[0] : '';
            
            // Buscar frecuencia
            const frecuenciaMatch = texto.match(/cada\s*(\d+)\s*(hora|horas|día|días|semana|semanas)/i);
            const frecuencia = frecuenciaMatch ? frecuenciaMatch[0] : '';
            
            // Buscar duración
            const duracionMatch = texto.match(/\b(\d+)\s*(día|días|semana|semanas|mes|meses)\b/i);
            const duracion = duracionMatch ? duracionMatch[0] : '';
            
            // Buscar presentación
            let presentacion = '';
            const presentacionMatch = texto.match(/\b(tabletas|comprimidos|jarabe|inyectable|gotas|capsulas|solucion|suspension|crema|unguento|parches)\b/i);
            if (presentacionMatch) {
                presentacion = presentacionMatch[0];
            }
            
            // Verificar que no esté duplicado
            const existe = medicamentos.some(m => m.nombre.toLowerCase() === nombre.toLowerCase());
            if (!existe) {
                medicamentos.push({
                    nombre: nombre.charAt(0).toUpperCase() + nombre.slice(1),
                    dosis: dosis,
                    frecuencia: frecuencia,
                    duracion: duracion,
                    presentacion: presentacion
                });
            }
        }
    });
    
    // ===== 2. SI NO SE ENCONTRÓ NINGUNO, BUSCAR PATRONES =====
    if (medicamentos.length === 0 && texto.length > 5) {
        // Buscar patrón: "NOMBRE en presentación de DOSIS cada FRECUENCIA durante DURACIÓN"
        const patronCompleto = texto.match(/^([A-Za-záéíóúñÑ\s]+)\s+(?:en\s+)?(?:tabletas?|comprimidos?|capsulas?|jarabe|inyectable|gotas|solucion)\s+(?:de\s+)?(\d+\s*(?:mg|g|ml))\s+(?:cada\s+)?(\d+\s*(?:hora|horas|día|días))\s+(?:durante\s+)?(\d+\s*(?:día|días|semana|semanas))/i);
        
        if (patronCompleto) {
            const nombre = patronCompleto[1].trim();
            const dosis = patronCompleto[2] || '';
            const frecuencia = patronCompleto[3] || '';
            const duracion = patronCompleto[4] || '';
            
            medicamentos.push({
                nombre: nombre.charAt(0).toUpperCase() + nombre.slice(1).toLowerCase(),
                dosis: dosis,
                frecuencia: frecuencia,
                duracion: duracion,
                presentacion: 'Tabletas'
            });
        } else {
            // Buscar patrón simple: "NOMBRE DOSIS"
            const patronSimple = texto.match(/^([A-Za-záéíóúñÑ\s]+)\s+(\d+\s*(?:mg|g|ml))/i);
            if (patronSimple) {
                const nombre = patronSimple[1].trim();
                const dosis = patronSimple[2] || '';
                
                medicamentos.push({
                    nombre: nombre.charAt(0).toUpperCase() + nombre.slice(1).toLowerCase(),
                    dosis: dosis,
                    frecuencia: '',
                    duracion: '',
                    presentacion: ''
                });
            }
        }
    }
    
    return medicamentos;
}

// ===== EVENTOS PARA AUTOCOMPLETADO =====
// Cuando cambia el tratamiento (con debounce)
let timeoutTratamiento;
tratamientoInput?.addEventListener('input', function() {
    clearTimeout(timeoutTratamiento);
    timeoutTratamiento = setTimeout(() => {
        if (generarRecetaCheckbox?.checked) {
            // Si el usuario escribió manualmente en la receta, preguntar si quiere actualizar
            if (tieneCambiosManuales()) {
                // Mostrar notificación sugerente
                const alerta = document.getElementById('recetaSyncAlert');
                if (!alerta) {
                    const div = document.createElement('div');
                    div.id = 'recetaSyncAlert';
                    div.className = 'alert alert-warning alert-dismissible fade show';
                    div.innerHTML = `
                        <i class="fas fa-sync me-2"></i>
                        El tratamiento ha cambiado. 
                        <button type="button" class="btn btn-sm btn-primary ms-2" onclick="actualizarRecetaForzado()">
                            <i class="fas fa-sync me-1"></i> Actualizar receta
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    recetaContainer.prepend(div);
                }
            } else {
                autocompletarReceta();
            }
        }
    }, 500);
});

// ===== FUNCIÓN PARA ACTUALIZAR RECETA FORZADAMENTE =====
window.actualizarRecetaForzado = function() {
    // Eliminar alerta
    const alerta = document.getElementById('recetaSyncAlert');
    if (alerta) alerta.remove();
    
    // Forzar autocompletado
    autocompletarReceta(true);
    
    // Mostrar mensaje de éxito
    mostrarAlertaReceta('✅ Receta actualizada con el nuevo tratamiento', 'success');
};

// ===== FUNCIÓN PARA MOSTRAR ALERTA =====
function mostrarAlertaReceta(mensaje, tipo = 'success') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show`;
    alerta.role = 'alert';
    alerta.innerHTML = `${mensaje} <button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
    recetaContainer.prepend(alerta);
    setTimeout(() => alerta.remove(), 5000);
}

// ===== RESETEAR VALORES CUANDO EL USUARIO EDITA MANUALMENTE =====
Object.keys(recetaCampos).forEach(key => {
    const campo = recetaCampos[key];
    if (campo) {
        campo.addEventListener('change', function() {
            guardarValoresOriginales();
            // Si el usuario edita manualmente, ocultar la alerta de sincronización
            const alerta = document.getElementById('recetaSyncAlert');
            if (alerta) alerta.remove();
        });
        campo.addEventListener('input', function() {
            guardarValoresOriginales();
        });
    }
});

// ===== INICIALIZAR GUARDADO DE VALORES =====
setTimeout(guardarValoresOriginales, 500);

//------------------------------------------

// ============================================
// MÚLTIPLES MEDICAMENTOS EN RECETA
// ============================================
let medicamentoIndex = 1;

document.getElementById('agregarMedicamento')?.addEventListener('click', function() {
    const container = document.getElementById('medicamentosContainer');
    const newIndex = medicamentoIndex++;
    
    const row = document.createElement('div');
    row.className = 'medicamento-row border rounded-3 p-3 mb-3';
    row.style.cssText = 'background: #f8faff; border-color: #e0e7ff !important;';
    row.dataset.index = newIndex;
    
    row.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold text-primary">Medicamento #${newIndex + 1}</span>
            <button type="button" class="btn btn-sm btn-danger eliminar-medicamento">
                <i class="fas fa-times me-1"></i> Eliminar
            </button>
        </div>
        <div class="row g-2">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                <input type="text" name="receta_medicamentos[${newIndex}][medicamento]" class="form-control form-control-sm medicamento-input" placeholder="Ej: Paracetamol">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Presentación</label>
                <input type="text" name="receta_medicamentos[${newIndex}][presentacion]" class="form-control form-control-sm" placeholder="Ej: Tabletas">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Concentración</label>
                <input type="text" name="receta_medicamentos[${newIndex}][concentracion]" class="form-control form-control-sm" placeholder="Ej: 500mg">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Dosis</label>
                <input type="text" name="receta_medicamentos[${newIndex}][dosis]" class="form-control form-control-sm" placeholder="Ej: 1 tableta">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Frecuencia</label>
                <input type="text" name="receta_medicamentos[${newIndex}][frecuencia]" class="form-control form-control-sm" placeholder="Ej: Cada 8 horas">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Duración</label>
                <input type="text" name="receta_medicamentos[${newIndex}][duracion]" class="form-control form-control-sm" placeholder="Ej: 7 días">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Indicaciones específicas</label>
                <input type="text" name="receta_medicamentos[${newIndex}][indicaciones]" class="form-control form-control-sm" placeholder="Instrucciones para este medicamento...">
            </div>
        </div>
    `;
    
    container.appendChild(row);
    actualizarBotonesEliminar();
});

// Eliminar medicamento
document.addEventListener('click', function(e) {
    if (e.target.closest('.eliminar-medicamento')) {
        const btn = e.target.closest('.eliminar-medicamento');
        const row = btn.closest('.medicamento-row');
        if (document.querySelectorAll('.medicamento-row').length > 1) {
            row.remove();
            actualizarNumeros();
            actualizarBotonesEliminar();
        } else {
            mostrarAlertaCompact('Debe haber al menos un medicamento.', 'warning');
        }
    }
});

function actualizarNumeros() {
    document.querySelectorAll('.medicamento-row').forEach((row, index) => {
        const label = row.querySelector('.fw-semibold');
        if (label) {
            label.textContent = `Medicamento #${index + 1}`;
        }
        // Actualizar índices de los inputs
        const inputs = row.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/\[\d+\]/, `[${index}]`);
                input.setAttribute('name', newName);
            }
        });
    });
}

function actualizarBotonesEliminar() {
    const rows = document.querySelectorAll('.medicamento-row');
    const buttons = document.querySelectorAll('.eliminar-medicamento');
    buttons.forEach((btn, index) => {
        if (rows.length <= 1) {
            btn.style.display = 'none';
        } else {
            btn.style.display = 'inline-block';
        }
    });
}

// Inicializar
setTimeout(actualizarBotonesEliminar, 100);

//----------------------------------------------------------

// ============================================
// AUTOCOMPLETAR MÚLTIPLES MEDICAMENTOS
// ============================================
function autocompletarReceta(force = false) {
    if (!generarRecetaCheckbox?.checked) return;
    
    if (!force && tieneCambiosManuales()) {
        return;
    }
    
    const tratamiento = tratamientoInput?.value || '';
    const recomendaciones = recomendacionesInput?.value || '';
    
    if (!tratamiento) return;
    
    // Extraer múltiples medicamentos del tratamiento
    const medicamentosExtraidos = extraerMultiplesMedicamentos(tratamiento);
    
    console.log('🔍 Medicamentos extraídos:', medicamentosExtraidos);
    
    // Limpiar medicamentos existentes (excepto el primero)
    const container = document.getElementById('medicamentosContainer');
    const rows = container.querySelectorAll('.medicamento-row');
    
    // Mantener solo el primer row y limpiarlo
    rows.forEach((row, index) => {
        if (index === 0) {
            // Limpiar el primer row
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                if (input.classList.contains('medicamento-input')) {
                    input.value = '';
                } else {
                    input.value = '';
                }
            });
        } else {
            row.remove();
        }
    });
    
    // Si hay medicamentos extraídos, llenar
    if (medicamentosExtraidos.length > 0) {
        medicamentosExtraidos.forEach((med, index) => {
            if (index === 0) {
                // Usar el primer row
                const firstRow = container.querySelector('.medicamento-row');
                llenarFilaMedicamento(firstRow, med);
            } else {
                // Crear nuevas filas
                agregarFilaMedicamento(med);
            }
        });
    }
    
    // Actualizar contadores
    medicamentoIndex = medicamentosExtraidos.length;
    actualizarNumeros();
    actualizarBotonesEliminar();
    
    // Guardar valores originales
    setTimeout(guardarValoresOriginales, 100);
}

function llenarFilaMedicamento(row, med) {
    const inputs = row.querySelectorAll('input');
    const medicamentoInput = row.querySelector('.medicamento-input');
    
    if (medicamentoInput) medicamentoInput.value = med.nombre || '';
    
    // Mapear inputs por nombre
    const nombreMap = {};
    inputs.forEach(input => {
        const name = input.getAttribute('name');
        if (name) {
            const key = name.split('][').pop().replace(/\]$/, '');
            nombreMap[key] = input;
        }
    });
    
    if (nombreMap['presentacion']) nombreMap['presentacion'].value = med.presentacion || '';
    if (nombreMap['concentracion']) nombreMap['concentracion'].value = med.concentracion || '';
    if (nombreMap['dosis']) nombreMap['dosis'].value = med.dosis || '';
    if (nombreMap['frecuencia']) nombreMap['frecuencia'].value = med.frecuencia || '';
    if (nombreMap['duracion']) nombreMap['duracion'].value = med.duracion || '';
    if (nombreMap['indicaciones']) nombreMap['indicaciones'].value = med.indicaciones || '';
}

function agregarFilaMedicamento(med) {
    const container = document.getElementById('medicamentosContainer');
    const newIndex = medicamentoIndex++;
    
    const row = document.createElement('div');
    row.className = 'medicamento-row border rounded-3 p-3 mb-3';
    row.style.cssText = 'background: #f8faff; border-color: #e0e7ff !important;';
    row.dataset.index = newIndex;
    
    row.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-semibold text-primary">Medicamento #${newIndex + 1}</span>
            <button type="button" class="btn btn-sm btn-danger eliminar-medicamento">
                <i class="fas fa-times me-1"></i> Eliminar
            </button>
        </div>
        <div class="row g-2">
            <div class="col-md-4">
                <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                <input type="text" name="receta_medicamentos[${newIndex}][medicamento]" class="form-control form-control-sm medicamento-input" placeholder="Ej: Paracetamol" value="${med.nombre || ''}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Presentación</label>
                <input type="text" name="receta_medicamentos[${newIndex}][presentacion]" class="form-control form-control-sm" placeholder="Ej: Tabletas" value="${med.presentacion || ''}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Concentración</label>
                <input type="text" name="receta_medicamentos[${newIndex}][concentracion]" class="form-control form-control-sm" placeholder="Ej: 500mg" value="${med.concentracion || ''}">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-semibold">Dosis</label>
                <input type="text" name="receta_medicamentos[${newIndex}][dosis]" class="form-control form-control-sm" placeholder="Ej: 1 tableta" value="${med.dosis || ''}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Frecuencia</label>
                <input type="text" name="receta_medicamentos[${newIndex}][frecuencia]" class="form-control form-control-sm" placeholder="Ej: Cada 8 horas" value="${med.frecuencia || ''}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Duración</label>
                <input type="text" name="receta_medicamentos[${newIndex}][duracion]" class="form-control form-control-sm" placeholder="Ej: 7 días" value="${med.duracion || ''}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Indicaciones específicas</label>
                <input type="text" name="receta_medicamentos[${newIndex}][indicaciones]" class="form-control form-control-sm" placeholder="Instrucciones para este medicamento..." value="${med.indicaciones || ''}">
            </div>
        </div>
    `;
    
    container.appendChild(row);
}

function extraerMultiplesMedicamentos(texto) {
    const medicamentos = [];
    
    if (!texto) return medicamentos;
    
    // Dividir por saltos de línea o puntos y comas
    const lineas = texto.split(/[\n;.]+/);
    
    for (const linea of lineas) {
        const trimmed = linea.trim();
        if (trimmed.length < 3) continue;
        
        const medicamento = extraerMedicamentoSimple(trimmed);
        if (medicamento) {
            medicamentos.push(medicamento);
        }
    }
    
    // Si no se encontró nada, intentar con el texto completo
    if (medicamentos.length === 0) {
        const med = extraerMedicamentoSimple(texto);
        if (med) medicamentos.push(med);
    }
    
    return medicamentos;
}

function extraerMedicamentoSimple(texto) {
    if (!texto || texto.length < 3) return null;
    
    // Lista de medicamentos comunes
    const medicamentosConocidos = [
        'paracetamol', 'ibuprofeno', 'aspirina', 'amoxicilina', 'azitromicina',
        'metformina', 'enalapril', 'losartan', 'omeprazol', 'ranitidina',
        'diclofenaco', 'naproxeno', 'ketorolaco', 'prednisona', 'metilprednisolona',
        'dexametasona', 'salbutamol', 'budesonida', 'montelukast', 'insulina',
        'levotiroxina', 'carbimazol', 'fenitoina', 'carbamazepina', 'valproato',
        'escitalopram', 'sertralina', 'fluoxetina', 'venlafaxina', 'duloxetina',
        'clonazepam', 'alprazolam', 'diazepam', 'zolpidem', 'melatonina'
    ];
    
    const textoLower = texto.toLowerCase();
    let nombre = '';
    let dosis = '';
    let frecuencia = '';
    let duracion = '';
    let presentacion = '';
    let concentracion = '';
    
    // Buscar medicamento conocido
    for (const med of medicamentosConocidos) {
        if (textoLower.includes(med.toLowerCase())) {
            nombre = med.charAt(0).toUpperCase() + med.slice(1);
            break;
        }
    }
    
    // Si no se encontró, usar la primera palabra que parezca un medicamento
    if (!nombre) {
        const palabras = texto.split(/[\s,;]+/);
        for (const palabra of palabras) {
            if (palabra.length > 3 && !['con', 'por', 'para', 'cada', 'dosis', 'mg', 'g', 'ml', 'tableta', 'comprimido'].includes(palabra.toLowerCase())) {
                nombre = palabra.charAt(0).toUpperCase() + palabra.slice(1);
                break;
            }
        }
    }
    
    if (!nombre) return null;
    
    // Extraer dosis
    const dosisMatch = texto.match(/\b(\d+)\s*(mg|g|ml|mcg|ug|UI)\b/i);
    if (dosisMatch) dosis = dosisMatch[0];
    
    // Extraer concentración
    const concentracionMatch = texto.match(/\b(\d+)\s*(mg|g|ml)\s*(?:por|en)\s*(?:tableta|comprimido|capsula)\b/i);
    if (concentracionMatch) concentracion = concentracionMatch[0];
    else if (dosis) concentracion = dosis;
    
    // Extraer frecuencia
    const frecuenciaMatch = texto.match(/cada\s*(\d+)\s*(hora|horas|día|días|semana|semanas)/i);
    if (frecuenciaMatch) frecuencia = frecuenciaMatch[0];
    
    // Extraer duración
    const duracionMatch = texto.match(/\b(\d+)\s*(día|días|semana|semanas|mes|meses)\b/i);
    if (duracionMatch) duracion = duracionMatch[0];
    
    // Extraer presentación
    const presentacionMatch = texto.match(/\b(tabletas|comprimidos|jarabe|inyectable|gotas|capsulas|solucion|suspension|crema|unguento|parches)\b/i);
    if (presentacionMatch) presentacion = presentacionMatch[0];
    
    return {
        nombre: nombre,
        dosis: dosis,
        frecuencia: frecuencia,
        duracion: duracion,
        presentacion: presentacion,
        concentracion: concentracion,
        indicaciones: ''
    };
}
//-----------------------------------------------------------
// ============================================
// OCULTAR PRESIÓN ARTERIAL EN NIÑOS (< 15 años)
// ============================================
function verificarEdadParaPresion() {
    const fechaNacimiento = document.getElementById('fecha_nacimiento_paciente')?.value;
    const contenedorPresion = document.getElementById('presion_arterial_container');
    
    if (!fechaNacimiento || !contenedorPresion) return;
    
    const hoy = new Date();
    const nacimiento = new Date(fechaNacimiento);
    let edad = hoy.getFullYear() - nacimiento.getFullYear();
    const mes = hoy.getMonth() - nacimiento.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
        edad--;
    }
    
    if (edad < 15) {
        contenedorPresion.style.display = 'none';
        // Establecer valor por defecto
        document.querySelector('[name="presion_arterial"]').value = 'N/A (Paciente pediátrico)';
    } else {
        contenedorPresion.style.display = 'block';
        if (document.querySelector('[name="presion_arterial"]').value === 'N/A (Paciente pediátrico)') {
            document.querySelector('[name="presion_arterial"]').value = '';
        }
    }
}

// Ejecutar al cargar y al cambiar fecha de nacimiento
document.addEventListener('DOMContentLoaded', function() {
    const fechaInput = document.getElementById('fecha_nacimiento_paciente');
    if (fechaInput) {
        fechaInput.addEventListener('change', verificarEdadParaPresion);
        fechaInput.addEventListener('input', verificarEdadParaPresion);
        // Ejecutar inicialmente
        setTimeout(verificarEdadParaPresion, 500);
    }
});

</script>
@endpush