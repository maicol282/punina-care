@extends('layouts.app')

@section('title', 'Nuevo Seguimiento')
@section('page-title', 'Registrar Seguimiento')

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Información de la Consulta -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-notes-medical me-2"></i>
                    Seguimiento - Consulta del {{ $historial->fecha_consulta->format('d/m/Y') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Paciente:</strong> {{ $historial->paciente->nombre_completo }}</p>
                        <p><strong>Motivo:</strong> {{ $historial->motivo_consulta }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Diagnóstico:</strong> {{ Str::limit($historial->diagnostico, 100) }}</p>
                        <p><strong>Tratamiento:</strong> {{ Str::limit($historial->tratamiento, 100) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- INICIO DEL FORMULARIO -->
        <form action="{{ route('seguimientos.store', $historial) }}" method="POST">
            @csrf
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2 text-primary"></i>Datos del Seguimiento</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_seguimiento" class="form-label">Fecha de Seguimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('fecha_seguimiento') is-invalid @enderror" 
                                   id="fecha_seguimiento" name="fecha_seguimiento" 
                                   value="{{ old('fecha_seguimiento', date('Y-m-d')) }}" required>
                            @error('fecha_seguimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="proxima_cita" class="form-label">Próxima Cita</label>
                            <input type="date" class="form-control @error('proxima_cita') is-invalid @enderror" 
                                   id="proxima_cita" name="proxima_cita" value="{{ old('proxima_cita') }}">
                            @error('proxima_cita')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="evolucion" class="form-label">Evolución del Paciente <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('evolucion') is-invalid @enderror" 
                                  id="evolucion" name="evolucion" rows="4" 
                                  placeholder="Describa la evolución del paciente desde la última consulta..." required>{{ old('evolucion') }}</textarea>
                        @error('evolucion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nuevos_sintomas" class="form-label">Nuevos Síntomas</label>
                        <textarea class="form-control @error('nuevos_sintomas') is-invalid @enderror" 
                                  id="nuevos_sintomas" name="nuevos_sintomas" rows="2" 
                                  placeholder="Síntomas nuevos o cambios en los existentes...">{{ old('nuevos_sintomas') }}</textarea>
                        @error('nuevos_sintomas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="medicamentos_ajustados" class="form-label">Ajuste de Medicamentos</label>
                        <textarea class="form-control @error('medicamentos_ajustados') is-invalid @enderror" 
                                  id="medicamentos_ajustados" name="medicamentos_ajustados" rows="2" 
                                  placeholder="Cambios en la medicación, dosis, etc...">{{ old('medicamentos_ajustados') }}</textarea>
                        @error('medicamentos_ajustados')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="recomendaciones" class="form-label">Recomendaciones <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('recomendaciones') is-invalid @enderror" 
                                  id="recomendaciones" name="recomendaciones" rows="3" 
                                  placeholder="Recomendaciones para el paciente..." required>{{ old('recomendaciones') }}</textarea>
                        @error('recomendaciones')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ========================================================== -->
            <!-- ===== RECETA MÉDICA - OPCIONAL ===== -->
            <!-- ========================================================== -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-prescription me-2 text-primary"></i> 
                        <span class="fw-semibold">Receta Médica</span>
                        <span class="badge bg-secondary ms-2">Opcional</span>
                    </div>
                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="generarRecetaSeguimiento" name="generar_receta" value="1" style="width: 40px; height: 20px;">
                            <label class="form-check-label fw-semibold" for="generarRecetaSeguimiento">
                                <span class="text-success" id="labelRecetaOff">🔘 No generar receta</span>
                                <span class="text-primary" id="labelRecetaOn" style="display: none;">✅ Generar receta</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="recetaContainerSeguimiento" style="display: none;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold text-primary mb-0">
                            <i class="fas fa-prescription me-2"></i> Datos de la Receta
                            <span class="badge bg-info ms-2">Completa los campos necesarios</span>
                        </h6>
                        <button type="button" class="btn btn-sm btn-success" id="agregarMedicamentoSeguimiento">
                            <i class="fas fa-plus me-1"></i> Agregar Medicamento
                        </button>
                    </div>
                    
                    <div id="medicamentosContainerSeguimiento" class="mt-2">
                        <!-- Fila de medicamento 1 (por defecto) -->
                        <div class="medicamento-row border rounded-3 p-3 mb-3" style="background: #f8faff; border-color: #e0e7ff !important;" data-index="0">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold text-primary">Medicamento #1</span>
                                <button type="button" class="btn btn-sm btn-danger eliminar-medicamento-seguimiento" style="display: none;">
                                    <i class="fas fa-times me-1"></i> Eliminar
                                </button>
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                                    <input type="text" name="receta_medicamentos[0][medicamento]" class="form-control form-control-sm medicamento-input-seguimiento" placeholder="Ej: Paracetamol">
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
                            <input type="date" name="receta_fecha_emision" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Advertencias</label>
                            <textarea name="receta_advertencias" class="form-control" rows="2" placeholder="Advertencias importantes..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Signos de Alarma</label>
                            <textarea name="receta_signos_alarma" class="form-control" rows="2" placeholder="Signos que requieren atención médica inmediata..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Recomendaciones no farmacológicas</label>
                            <textarea name="receta_recomendaciones_no_farmacologicas" class="form-control" rows="2" placeholder="Ejercicio, dieta, hidratación..."></textarea>
                        </div>
                    </div>

                    <!-- Mensaje informativo -->
                    <div class="alert alert-info mt-3" style="font-size: 12px;">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Nota:</strong> La receta se guardará asociada al historial clínico. 
                        Si ya existe una receta para este historial, se actualizará con los nuevos datos.
                    </div>
                </div>
            </div>

            <!-- ========================================================== -->

            <!-- BOTONES -->
            <div class="row mt-4">
                <div class="col-12 text-end">
                    <a href="{{ route('historial.show', $historial) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Seguimiento
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // TOGGLE RECETA - CAMBIO DE TEXTO
    // ============================================
    const generarRecetaCheckbox = document.getElementById('generarRecetaSeguimiento');
    const recetaContainer = document.getElementById('recetaContainerSeguimiento');
    const labelOff = document.getElementById('labelRecetaOff');
    const labelOn = document.getElementById('labelRecetaOn');

    if (generarRecetaCheckbox && recetaContainer) {
        generarRecetaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                recetaContainer.style.display = 'block';
                labelOff.style.display = 'none';
                labelOn.style.display = 'inline';
                setTimeout(() => {
                    recetaContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            } else {
                recetaContainer.style.display = 'none';
                labelOff.style.display = 'inline';
                labelOn.style.display = 'none';
            }
        });
    }

    // ============================================
    // AGREGAR / ELIMINAR MEDICAMENTOS
    // ============================================
    let medicamentoIndex = 1;

    document.getElementById('agregarMedicamentoSeguimiento')?.addEventListener('click', function() {
        const container = document.getElementById('medicamentosContainerSeguimiento');
        const newIndex = medicamentoIndex++;
        
        const row = document.createElement('div');
        row.className = 'medicamento-row border rounded-3 p-3 mb-3';
        row.style.cssText = 'background: #f8faff; border-color: #e0e7ff !important;';
        row.dataset.index = newIndex;
        
        row.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-semibold text-primary">Medicamento #${newIndex + 1}</span>
                <button type="button" class="btn btn-sm btn-danger eliminar-medicamento-seguimiento">
                    <i class="fas fa-times me-1"></i> Eliminar
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                    <input type="text" name="receta_medicamentos[${newIndex}][medicamento]" class="form-control form-control-sm medicamento-input-seguimiento" placeholder="Ej: Paracetamol">
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
        actualizarBotonesEliminarSeguimiento();
        actualizarNumerosSeguimiento();
    });

    // ===== ELIMINAR MEDICAMENTO =====
    document.addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-medicamento-seguimiento')) {
            const btn = e.target.closest('.eliminar-medicamento-seguimiento');
            const row = btn.closest('.medicamento-row');
            if (document.querySelectorAll('#medicamentosContainerSeguimiento .medicamento-row').length > 1) {
                row.remove();
                actualizarNumerosSeguimiento();
                actualizarBotonesEliminarSeguimiento();
            } else {
                mostrarAlerta('Debe haber al menos un medicamento.', 'warning');
            }
        }
    });

    function actualizarNumerosSeguimiento() {
        document.querySelectorAll('#medicamentosContainerSeguimiento .medicamento-row').forEach((row, index) => {
            const label = row.querySelector('.fw-semibold');
            if (label) {
                label.textContent = `Medicamento #${index + 1}`;
            }
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, `[${index}]`);
                    input.setAttribute('name', newName);
                }
            });
        });
    }

    function actualizarBotonesEliminarSeguimiento() {
        const rows = document.querySelectorAll('#medicamentosContainerSeguimiento .medicamento-row');
        const buttons = document.querySelectorAll('.eliminar-medicamento-seguimiento');
        buttons.forEach((btn) => {
            if (rows.length <= 1) {
                btn.style.display = 'none';
            } else {
                btn.style.display = 'inline-block';
            }
        });
    }

    function mostrarAlerta(mensaje, tipo = 'danger') {
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

    // Inicializar
    setTimeout(actualizarBotonesEliminarSeguimiento, 100);
});
</script>
@endpush