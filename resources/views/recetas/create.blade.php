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
            <form action="{{ route('recetas.store', $historial) }}" method="POST">
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
                                <select name="receta_medicamentos[0][presentacion]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="Tableta">Tableta</option>
                                    <option value="Cápsula">Cápsula</option>
                                    <option value="Jarabe">Jarabe</option>
                                    <option value="Suspensión">Suspensión</option>
                                    <option value="Inyectable">Inyectable</option>
                                    <option value="Gotas">Gotas</option>
                                    <option value="Crema">Crema</option>
                                    <option value="Ungüento">Ungüento</option>
                                    <option value="Supositorio">Supositorio</option>
                                    <option value="Parche">Parche</option>
                                    <option value="Inhalador">Inhalador</option>
                                    <option value="Solución">Solución</option>
                                    <option value="Polvo">Polvo</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Concentración</label>
                                <select name="receta_medicamentos[0][concentracion]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="5mg">5mg</option>
                                    <option value="10mg">10mg</option>
                                    <option value="20mg">20mg</option>
                                    <option value="25mg">25mg</option>
                                    <option value="50mg">50mg</option>
                                    <option value="100mg">100mg</option>
                                    <option value="125mg">125mg</option>
                                    <option value="200mg">200mg</option>
                                    <option value="250mg">250mg</option>
                                    <option value="400mg">400mg</option>
                                    <option value="500mg">500mg</option>
                                    <option value="600mg">600mg</option>
                                    <option value="800mg">800mg</option>
                                    <option value="1g">1g</option>
                                    <option value="2g">2g</option>
                                    <option value="100mg/5ml">100mg/5ml</option>
                                    <option value="250mg/5ml">250mg/5ml</option>
                                    <option value="500mg/5ml">500mg/5ml</option>
                                </select>
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
                                <select name="receta_medicamentos[0][dosis]" class="form-select form-select-sm" required>
                                    <option value="">Seleccione</option>
                                    <option value="1 tableta">1 tableta</option>
                                    <option value="2 tabletas">2 tabletas</option>
                                    <option value="3 tabletas">3 tabletas</option>
                                    <option value="1 cápsula">1 cápsula</option>
                                    <option value="2 cápsulas">2 cápsulas</option>
                                    <option value="5ml">5ml</option>
                                    <option value="10ml">10ml</option>
                                    <option value="15ml">15ml</option>
                                    <option value="20ml">20ml</option>
                                    <option value="1 gota">1 gota</option>
                                    <option value="2 gotas">2 gotas</option>
                                    <option value="3 gotas">3 gotas</option>
                                    <option value="1 aplicación">1 aplicación</option>
                                    <option value="1 inhalación">1 inhalación</option>
                                    <option value="2 inhalaciones">2 inhalaciones</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Frecuencia <span class="text-danger">*</span></label>
                                <select name="receta_medicamentos[0][frecuencia]" class="form-select form-select-sm" required>
                                    <option value="">Seleccione</option>
                                    <option value="Cada 4 horas">Cada 4 horas</option>
                                    <option value="Cada 6 horas">Cada 6 horas</option>
                                    <option value="Cada 8 horas">Cada 8 horas</option>
                                    <option value="Cada 12 horas">Cada 12 horas</option>
                                    <option value="Cada 24 horas">Cada 24 horas</option>
                                    <option value="2 veces al día">2 veces al día</option>
                                    <option value="3 veces al día">3 veces al día</option>
                                    <option value="4 veces al día">4 veces al día</option>
                                    <option value="Una vez al día">Una vez al día</option>
                                    <option value="En la mañana">En la mañana</option>
                                    <option value="En la noche">En la noche</option>
                                    <option value="Antes de comer">Antes de comer</option>
                                    <option value="Después de comer">Después de comer</option>
                                    <option value="Según necesidad">Según necesidad</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Duración <span class="text-danger">*</span></label>
                                <select name="receta_medicamentos[0][duracion]" class="form-select form-select-sm" required>
                                    <option value="">Seleccione</option>
                                    <option value="3 días">3 días</option>
                                    <option value="5 días">5 días</option>
                                    <option value="7 días">7 días</option>
                                    <option value="10 días">10 días</option>
                                    <option value="14 días">14 días</option>
                                    <option value="21 días">21 días</option>
                                    <option value="1 mes">1 mes</option>
                                    <option value="2 meses">2 meses</option>
                                    <option value="3 meses">3 meses</option>
                                    <option value="6 meses">6 meses</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Cantidad (Números y Letras)</label>
                                <select name="receta_medicamentos[0][cantidad]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="1 (uno)">1 (uno)</option>
                                    <option value="2 (dos)">2 (dos)</option>
                                    <option value="3 (tres)">3 (tres)</option>
                                    <option value="4 (cuatro)">4 (cuatro)</option>
                                    <option value="5 (cinco)">5 (cinco)</option>
                                    <option value="6 (seis)">6 (seis)</option>
                                    <option value="7 (siete)">7 (siete)</option>
                                    <option value="8 (ocho)">8 (ocho)</option>
                                    <option value="9 (nueve)">9 (nueve)</option>
                                    <option value="10 (diez)">10 (diez)</option>
                                    <option value="15 (quince)">15 (quince)</option>
                                    <option value="20 (veinte)">20 (veinte)</option>
                                    <option value="30 (treinta)">30 (treinta)</option>
                                    <option value="50 (cincuenta)">50 (cincuenta)</option>
                                </select>
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