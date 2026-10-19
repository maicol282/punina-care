@extends('layouts.app')

@section('title', 'Nueva Receta Médica')
@section('page-title', 'Nueva Receta Médica')

@section('content')
<div class="container-fluid px-0">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                <i class="fas fa-prescription me-2 text-primary"></i>
                Nueva Receta Médica
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('recetas.store') }}" method="POST">
                @csrf

                <!-- Datos generales -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Paciente <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{ $historial->paciente->nombre ?? 'N/A' }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Fecha de Emisión <span class="text-danger">*</span></label>
                        <input type="date" name="fecha_emision" class="form-control" value="{{ old('fecha_emision', date('Y-m-d')) }}" required>
                    </div>
                </div>

                <!-- Sección de medicamentos -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-primary mb-0">
                        <i class="fas fa-prescription me-2"></i> Medicamentos
                    </h6>
                    <button type="button" class="btn btn-sm btn-success" id="agregarMedicamento">
                        <i class="fas fa-plus me-1"></i> Agregar Medicamento
                    </button>
                </div>
                
                <div id="medicamentosContainer">
                    <!-- Medicamento #1 por defecto -->
                    <div class="medicamento-row border rounded-3 p-3 mb-3" style="background: #f8faff;" data-index="0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-semibold text-primary">Medicamento #1</span>
                            <button type="button" class="btn btn-sm btn-danger eliminar-medicamento" disabled>
                                <i class="fas fa-times me-1"></i> Eliminar
                            </button>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                                <input type="text" name="receta_medicamentos[0][medicamento]" class="form-control form-control-sm" placeholder="Ej: Paracetamol" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Presentación</label>
                                <input type="text" name="receta_medicamentos[0][presentacion]" class="form-control form-control-sm" placeholder="Ej: Tabletas">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Concentración</label>
                                <input type="text" name="receta_medicamentos[0][concentracion]" class="form-control form-control-sm" placeholder="Ej: 500mg">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Vía de Administración</label>
                                <select name="receta_medicamentos[0][via]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="Oral">Oral</option>
                                    <option value="Intravenosa">Intravenosa</option>
                                    <option value="Intramuscular">Intramuscular</option>
                                    <option value="Subcutánea">Subcutánea</option>
                                    <option value="Tópica">Tópica</option>
                                    <option value="Sublingual">Sublingual</option>
                                    <option value="Rectal">Rectal</option>
                                    <option value="Inhalatoria">Inhalatoria</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Dosis <span class="text-danger">*</span></label>
                                <input type="text" name="receta_medicamentos[0][dosis]" class="form-control form-control-sm" placeholder="Ej: 1 tableta" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Frecuencia <span class="text-danger">*</span></label>
                                <input type="text" name="receta_medicamentos[0][frecuencia]" class="form-control form-control-sm" placeholder="Ej: Cada 8 horas" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Duración <span class="text-danger">*</span></label>
                                <input type="text" name="receta_medicamentos[0][duracion]" class="form-control form-control-sm" placeholder="Ej: 7 días" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Cantidad (Números y Letras)</label>
                                <input type="text" name="receta_medicamentos[0][cantidad]" class="form-control form-control-sm" placeholder="Ej: 2 (dos)">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Indicaciones específicas</label>
                                <input type="text" name="receta_medicamentos[0][indicaciones]" class="form-control form-control-sm" placeholder="Instrucciones para este medicamento...">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Advertencias para este medicamento</label>
                                <input type="text" name="receta_medicamentos[0][advertencias]" class="form-control form-control-sm" placeholder="Ej: Tomar con alimentos, no conducir...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advertencias Generales -->
                <div class="row g-3 mt-3">
                    <div class="col-12">
                        <label class="form-label fw-semibold">Advertencias Generales</label>
                        <textarea name="advertencias" class="form-control" rows="2" placeholder="Advertencias para el paciente..."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Signos de Alarma</label>
                        <textarea name="signos_alarma" class="form-control" rows="2" placeholder="Signos de alarma a tener en cuenta..."></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Recomendaciones no farmacológicas</label>
                        <textarea name="recomendaciones_no_farmacologicas" class="form-control" rows="2" placeholder="Recomendaciones adicionales..."></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Receta
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let medicamentoIndex = 1; // Empezamos en 1 porque el 0 ya está en el HTML

    // ===== AGREGAR MEDICAMENTO =====
    document.getElementById('agregarMedicamento')?.addEventListener('click', function() {
        const container = document.getElementById('medicamentosContainer');
        const newIndex = medicamentoIndex++;
        
        const row = document.createElement('div');
        row.className = 'medicamento-row border rounded-3 p-3 mb-3';
        row.style.cssText = 'background: #f8faff;';
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
                    <input type="text" name="receta_medicamentos[${newIndex}][medicamento]" class="form-control form-control-sm" placeholder="Ej: Paracetamol" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Presentación</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][presentacion]" class="form-control form-control-sm" placeholder="Ej: Tabletas">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Concentración</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][concentracion]" class="form-control form-control-sm" placeholder="Ej: 500mg">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Vía de Administración</label>
                    <select name="receta_medicamentos[${newIndex}][via]" class="form-select form-select-sm">
                        <option value="">Seleccione</option>
                        <option value="Oral">Oral</option>
                        <option value="Intravenosa">Intravenosa</option>
                        <option value="Intramuscular">Intramuscular</option>
                        <option value="Subcutánea">Subcutánea</option>
                        <option value="Tópica">Tópica</option>
                        <option value="Sublingual">Sublingual</option>
                        <option value="Rectal">Rectal</option>
                        <option value="Inhalatoria">Inhalatoria</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Dosis <span class="text-danger">*</span></label>
                    <input type="text" name="receta_medicamentos[${newIndex}][dosis]" class="form-control form-control-sm" placeholder="Ej: 1 tableta" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Frecuencia <span class="text-danger">*</span></label>
                    <input type="text" name="receta_medicamentos[${newIndex}][frecuencia]" class="form-control form-control-sm" placeholder="Ej: Cada 8 horas" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Duración <span class="text-danger">*</span></label>
                    <input type="text" name="receta_medicamentos[${newIndex}][duracion]" class="form-control form-control-sm" placeholder="Ej: 7 días" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Cantidad (Números y Letras)</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][cantidad]" class="form-control form-control-sm" placeholder="Ej: 2 (dos)">
                </div>
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Indicaciones específicas</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][indicaciones]" class="form-control form-control-sm" placeholder="Instrucciones para este medicamento...">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Advertencias para este medicamento</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][advertencias]" class="form-control form-control-sm" placeholder="Ej: Tomar con alimentos, no conducir...">
                </div>
            </div>
        `;
        
        container.appendChild(row);
        actualizarBotonesEliminar();
        actualizarNumeros();
    });

    // ===== ELIMINAR MEDICAMENTO =====
    document.addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-medicamento')) {
            const btn = e.target.closest('.eliminar-medicamento');
            const row = btn.closest('.medicamento-row');
            if (document.querySelectorAll('.medicamento-row').length > 1) {
                row.remove();
                actualizarNumeros();
                actualizarBotonesEliminar();
            }
        }
    });

    function actualizarNumeros() {
        document.querySelectorAll('.medicamento-row').forEach((row, index) => {
            const label = row.querySelector('.fw-semibold');
            if (label) {
                label.textContent = `Medicamento #${index + 1}`;
            }
            const inputs = row.querySelectorAll('input, select');
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
        buttons.forEach((btn) => {
            if (rows.length <= 1) {
                btn.disabled = true;
            } else {
                btn.disabled = false;
            }
        });
    }

    actualizarBotonesEliminar();
});
</script>
@endpush
@endsection