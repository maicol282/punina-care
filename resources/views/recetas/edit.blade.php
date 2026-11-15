@extends('layouts.app')

@section('title', 'Editar Receta Médica')
@section('page-title', 'Editar Receta Médica')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-prescription me-2 text-primary"></i>
            Editar Receta Médica
        </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('recetas.update', $receta) }}" method="POST">
            @csrf
            @method('PUT')

            @php
                $medicamentos = $receta->medicamentos_json ? json_decode($receta->medicamentos_json, true) : [];
                if (empty($medicamentos)) {
                    $medicamentos = [
                        [
                            'medicamento' => $receta->medicamento,
                            'presentacion' => $receta->presentacion,
                            'concentracion' => $receta->concentracion,
                            'dosis' => $receta->dosis,
                            'frecuencia' => $receta->frecuencia,
                            'duracion' => $receta->duracion,
                            'indicaciones' => $receta->indicaciones,
                        ]
                    ];
                }
            @endphp

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-primary mb-0">
                    <i class="fas fa-prescription me-2"></i> Medicamentos
                </h6>
                <button type="button" class="btn btn-sm btn-success" id="agregarMedicamento">
                    <i class="fas fa-plus me-1"></i> Agregar Medicamento
                </button>
            </div>
            
            <div id="medicamentosContainer">
                @foreach($medicamentos as $index => $med)
                <div class="medicamento-row border rounded-3 p-3 mb-3" style="background: #f8faff;" data-index="{{ $index }}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold text-primary">Medicamento #{{ $index + 1 }}</span>
                        <button type="button" class="btn btn-sm btn-danger eliminar-medicamento" {{ count($medicamentos) <= 1 ? 'disabled' : '' }}>
                            <i class="fas fa-times me-1"></i> Eliminar
                        </button>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                            <input type="text" name="receta_medicamentos[{{ $index }}][medicamento]" class="form-control form-control-sm" value="{{ $med['medicamento'] ?? '' }}" placeholder="Ej: Paracetamol">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Presentación</label>
                            <select name="receta_medicamentos[{{ $index }}][presentacion]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="Tableta" {{ ($med['presentacion'] ?? '') == 'Tableta' ? 'selected' : '' }}>Tableta</option>
                                    <option value="Cápsula" {{ ($med['presentacion'] ?? '') == 'Cápsula' ? 'selected' : '' }}>Cápsula</option>
                                    <option value="Jarabe" {{ ($med['presentacion'] ?? '') == 'Jarabe' ? 'selected' : '' }}>Jarabe</option>
                                    <option value="Suspensión" {{ ($med['presentacion'] ?? '') == 'Suspensión' ? 'selected' : '' }}>Suspensión</option>
                                    <option value="Inyectable" {{ ($med['presentacion'] ?? '') == 'Inyectable' ? 'selected' : '' }}>Inyectable</option>
                                    <option value="Gotas" {{ ($med['presentacion'] ?? '') == 'Gotas' ? 'selected' : '' }}>Gotas</option>
                                    <option value="Crema" {{ ($med['presentacion'] ?? '') == 'Crema' ? 'selected' : '' }}>Crema</option>
                                    <option value="Ungüento" {{ ($med['presentacion'] ?? '') == 'Ungüento' ? 'selected' : '' }}>Ungüento</option>
                                    <option value="Supositorio" {{ ($med['presentacion'] ?? '') == 'Supositorio' ? 'selected' : '' }}>Supositorio</option>
                                    <option value="Parche" {{ ($med['presentacion'] ?? '') == 'Parche' ? 'selected' : '' }}>Parche</option>
                                    <option value="Inhalador" {{ ($med['presentacion'] ?? '') == 'Inhalador' ? 'selected' : '' }}>Inhalador</option>
                                    <option value="Solución" {{ ($med['presentacion'] ?? '') == 'Solución' ? 'selected' : '' }}>Solución</option>
                                    <option value="Polvo" {{ ($med['presentacion'] ?? '') == 'Polvo' ? 'selected' : '' }}>Polvo</option>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Concentración</label>
                            <select name="receta_medicamentos[{{ $index }}][concentracion]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="5mg" {{ ($med['concentracion'] ?? '') == '5mg' ? 'selected' : '' }}>5mg</option>
                                    <option value="10mg" {{ ($med['concentracion'] ?? '') == '10mg' ? 'selected' : '' }}>10mg</option>
                                    <option value="20mg" {{ ($med['concentracion'] ?? '') == '20mg' ? 'selected' : '' }}>20mg</option>
                                    <option value="25mg" {{ ($med['concentracion'] ?? '') == '25mg' ? 'selected' : '' }}>25mg</option>
                                    <option value="50mg" {{ ($med['concentracion'] ?? '') == '50mg' ? 'selected' : '' }}>50mg</option>
                                    <option value="100mg" {{ ($med['concentracion'] ?? '') == '100mg' ? 'selected' : '' }}>100mg</option>
                                    <option value="125mg" {{ ($med['concentracion'] ?? '') == '125mg' ? 'selected' : '' }}>125mg</option>
                                    <option value="200mg" {{ ($med['concentracion'] ?? '') == '200mg' ? 'selected' : '' }}>200mg</option>
                                    <option value="250mg" {{ ($med['concentracion'] ?? '') == '250mg' ? 'selected' : '' }}>250mg</option>
                                    <option value="400mg" {{ ($med['concentracion'] ?? '') == '400mg' ? 'selected' : '' }}>400mg</option>
                                    <option value="500mg" {{ ($med['concentracion'] ?? '') == '500mg' ? 'selected' : '' }}>500mg</option>
                                    <option value="600mg" {{ ($med['concentracion'] ?? '') == '600mg' ? 'selected' : '' }}>600mg</option>
                                    <option value="800mg" {{ ($med['concentracion'] ?? '') == '800mg' ? 'selected' : '' }}>800mg</option>
                                    <option value="1g" {{ ($med['concentracion'] ?? '') == '1g' ? 'selected' : '' }}>1g</option>
                                    <option value="2g" {{ ($med['concentracion'] ?? '') == '2g' ? 'selected' : '' }}>2g</option>
                                    <option value="100mg/5ml" {{ ($med['concentracion'] ?? '') == '100mg/5ml' ? 'selected' : '' }}>100mg/5ml</option>
                                    <option value="250mg/5ml" {{ ($med['concentracion'] ?? '') == '250mg/5ml' ? 'selected' : '' }}>250mg/5ml</option>
                                    <option value="500mg/5ml" {{ ($med['concentracion'] ?? '') == '500mg/5ml' ? 'selected' : '' }}>500mg/5ml</option>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Vía de Administración</label>
                            <select name="receta_medicamentos[{{ $index }}][via]" class="form-select form-select-sm">
                                <option value="">Seleccione</option>
                                <option value="Oral" {{ ($med['via'] ?? '') == 'Oral' ? 'selected' : '' }}>Oral</option>
                                <option value="Intravenosa" {{ ($med['via'] ?? '') == 'Intravenosa' ? 'selected' : '' }}>Intravenosa</option>
                                <option value="Intramuscular" {{ ($med['via'] ?? '') == 'Intramuscular' ? 'selected' : '' }}>Intramuscular</option>
                                <option value="Subcutánea" {{ ($med['via'] ?? '') == 'Subcutánea' ? 'selected' : '' }}>Subcutánea</option>
                                <option value="Tópica" {{ ($med['via'] ?? '') == 'Tópica' ? 'selected' : '' }}>Tópica</option>
                                <option value="Sublingual" {{ ($med['via'] ?? '') == 'Sublingual' ? 'selected' : '' }}>Sublingual</option>
                                <option value="Rectal" {{ ($med['via'] ?? '') == 'Rectal' ? 'selected' : '' }}>Rectal</option>
                                <option value="Inhalatoria" {{ ($med['via'] ?? '') == 'Inhalatoria' ? 'selected' : '' }}>Inhalatoria</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Dosis</label>
                            <select name="receta_medicamentos[{{ $index }}][dosis]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="1 tableta" {{ ($med['dosis'] ?? '') == '1 tableta' ? 'selected' : '' }}>1 tableta</option>
                                    <option value="2 tabletas" {{ ($med['dosis'] ?? '') == '2 tabletas' ? 'selected' : '' }}>2 tabletas</option>
                                    <option value="3 tabletas" {{ ($med['dosis'] ?? '') == '3 tabletas' ? 'selected' : '' }}>3 tabletas</option>
                                    <option value="1 cápsula" {{ ($med['dosis'] ?? '') == '1 cápsula' ? 'selected' : '' }}>1 cápsula</option>
                                    <option value="2 cápsulas" {{ ($med['dosis'] ?? '') == '2 cápsulas' ? 'selected' : '' }}>2 cápsulas</option>
                                    <option value="5ml" {{ ($med['dosis'] ?? '') == '5ml' ? 'selected' : '' }}>5ml</option>
                                    <option value="10ml" {{ ($med['dosis'] ?? '') == '10ml' ? 'selected' : '' }}>10ml</option>
                                    <option value="15ml" {{ ($med['dosis'] ?? '') == '15ml' ? 'selected' : '' }}>15ml</option>
                                    <option value="20ml" {{ ($med['dosis'] ?? '') == '20ml' ? 'selected' : '' }}>20ml</option>
                                    <option value="1 gota" {{ ($med['dosis'] ?? '') == '1 gota' ? 'selected' : '' }}>1 gota</option>
                                    <option value="2 gotas" {{ ($med['dosis'] ?? '') == '2 gotas' ? 'selected' : '' }}>2 gotas</option>
                                    <option value="3 gotas" {{ ($med['dosis'] ?? '') == '3 gotas' ? 'selected' : '' }}>3 gotas</option>
                                    <option value="1 aplicación" {{ ($med['dosis'] ?? '') == '1 aplicación' ? 'selected' : '' }}>1 aplicación</option>
                                    <option value="1 inhalación" {{ ($med['dosis'] ?? '') == '1 inhalación' ? 'selected' : '' }}>1 inhalación</option>
                                    <option value="2 inhalaciones" {{ ($med['dosis'] ?? '') == '2 inhalaciones' ? 'selected' : '' }}>2 inhalaciones</option>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Frecuencia</label>
                            <select name="receta_medicamentos[{{ $index }}][frecuencia]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="Cada 4 horas" {{ ($med['frecuencia'] ?? '') == 'Cada 4 horas' ? 'selected' : '' }}>Cada 4 horas</option>
                                    <option value="Cada 6 horas" {{ ($med['frecuencia'] ?? '') == 'Cada 6 horas' ? 'selected' : '' }}>Cada 6 horas</option>
                                    <option value="Cada 8 horas" {{ ($med['frecuencia'] ?? '') == 'Cada 8 horas' ? 'selected' : '' }}>Cada 8 horas</option>
                                    <option value="Cada 12 horas" {{ ($med['frecuencia'] ?? '') == 'Cada 12 horas' ? 'selected' : '' }}>Cada 12 horas</option>
                                    <option value="Cada 24 horas" {{ ($med['frecuencia'] ?? '') == 'Cada 24 horas' ? 'selected' : '' }}>Cada 24 horas</option>
                                    <option value="2 veces al día" {{ ($med['frecuencia'] ?? '') == '2 veces al día' ? 'selected' : '' }}>2 veces al día</option>
                                    <option value="3 veces al día" {{ ($med['frecuencia'] ?? '') == '3 veces al día' ? 'selected' : '' }}>3 veces al día</option>
                                    <option value="4 veces al día" {{ ($med['frecuencia'] ?? '') == '4 veces al día' ? 'selected' : '' }}>4 veces al día</option>
                                    <option value="Una vez al día" {{ ($med['frecuencia'] ?? '') == 'Una vez al día' ? 'selected' : '' }}>Una vez al día</option>
                                    <option value="En la mañana" {{ ($med['frecuencia'] ?? '') == 'En la mañana' ? 'selected' : '' }}>En la mañana</option>
                                    <option value="En la noche" {{ ($med['frecuencia'] ?? '') == 'En la noche' ? 'selected' : '' }}>En la noche</option>
                                    <option value="Antes de comer" {{ ($med['frecuencia'] ?? '') == 'Antes de comer' ? 'selected' : '' }}>Antes de comer</option>
                                    <option value="Después de comer" {{ ($med['frecuencia'] ?? '') == 'Después de comer' ? 'selected' : '' }}>Después de comer</option>
                                    <option value="Según necesidad" {{ ($med['frecuencia'] ?? '') == 'Según necesidad' ? 'selected' : '' }}>Según necesidad</option>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Duración</label>
                            <select name="receta_medicamentos[{{ $index }}][duracion]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="3 días" {{ ($med['duracion'] ?? '') == '3 días' ? 'selected' : '' }}>3 días</option>
                                    <option value="5 días" {{ ($med['duracion'] ?? '') == '5 días' ? 'selected' : '' }}>5 días</option>
                                    <option value="7 días" {{ ($med['duracion'] ?? '') == '7 días' ? 'selected' : '' }}>7 días</option>
                                    <option value="10 días" {{ ($med['duracion'] ?? '') == '10 días' ? 'selected' : '' }}>10 días</option>
                                    <option value="14 días" {{ ($med['duracion'] ?? '') == '14 días' ? 'selected' : '' }}>14 días</option>
                                    <option value="21 días" {{ ($med['duracion'] ?? '') == '21 días' ? 'selected' : '' }}>21 días</option>
                                    <option value="1 mes" {{ ($med['duracion'] ?? '') == '1 mes' ? 'selected' : '' }}>1 mes</option>
                                    <option value="2 meses" {{ ($med['duracion'] ?? '') == '2 meses' ? 'selected' : '' }}>2 meses</option>
                                    <option value="3 meses" {{ ($med['duracion'] ?? '') == '3 meses' ? 'selected' : '' }}>3 meses</option>
                                    <option value="6 meses" {{ ($med['duracion'] ?? '') == '6 meses' ? 'selected' : '' }}>6 meses</option>
                                </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Cantidad (Números y Letras)</label>
                            <select name="receta_medicamentos[{{ $index }}][cantidad]" class="form-select form-select-sm">
                                    <option value="">Seleccione</option>
                                    <option value="1 (uno)" {{ ($med['cantidad'] ?? '') == '1 (uno)' ? 'selected' : '' }}>1 (uno)</option>
                                    <option value="2 (dos)" {{ ($med['cantidad'] ?? '') == '2 (dos)' ? 'selected' : '' }}>2 (dos)</option>
                                    <option value="3 (tres)" {{ ($med['cantidad'] ?? '') == '3 (tres)' ? 'selected' : '' }}>3 (tres)</option>
                                    <option value="4 (cuatro)" {{ ($med['cantidad'] ?? '') == '4 (cuatro)' ? 'selected' : '' }}>4 (cuatro)</option>
                                    <option value="5 (cinco)" {{ ($med['cantidad'] ?? '') == '5 (cinco)' ? 'selected' : '' }}>5 (cinco)</option>
                                    <option value="6 (seis)" {{ ($med['cantidad'] ?? '') == '6 (seis)' ? 'selected' : '' }}>6 (seis)</option>
                                    <option value="7 (siete)" {{ ($med['cantidad'] ?? '') == '7 (siete)' ? 'selected' : '' }}>7 (siete)</option>
                                    <option value="8 (ocho)" {{ ($med['cantidad'] ?? '') == '8 (ocho)' ? 'selected' : '' }}>8 (ocho)</option>
                                    <option value="9 (nueve)" {{ ($med['cantidad'] ?? '') == '9 (nueve)' ? 'selected' : '' }}>9 (nueve)</option>
                                    <option value="10 (diez)" {{ ($med['cantidad'] ?? '') == '10 (diez)' ? 'selected' : '' }}>10 (diez)</option>
                                    <option value="15 (quince)" {{ ($med['cantidad'] ?? '') == '15 (quince)' ? 'selected' : '' }}>15 (quince)</option>
                                    <option value="20 (veinte)" {{ ($med['cantidad'] ?? '') == '20 (veinte)' ? 'selected' : '' }}>20 (veinte)</option>
                                    <option value="30 (treinta)" {{ ($med['cantidad'] ?? '') == '30 (treinta)' ? 'selected' : '' }}>30 (treinta)</option>
                                    <option value="50 (cincuenta)" {{ ($med['cantidad'] ?? '') == '50 (cincuenta)' ? 'selected' : '' }}>50 (cincuenta)</option>
                                </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Indicaciones específicas</label>
                            <input type="text" name="receta_medicamentos[{{ $index }}][indicaciones]" class="form-control form-control-sm" value="{{ $med['indicaciones'] ?? '' }}" placeholder="Instrucciones para este medicamento...">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Advertencias para este medicamento</label>
                            <input type="text" name="receta_medicamentos[{{ $index }}][advertencias]" class="form-control form-control-sm" value="{{ $med['advertencias'] ?? '' }}" placeholder="Ej: Tomar con alimentos, no conducir...">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Campos generales de la receta -->
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fecha de Emisión</label>
                    <input type="date" name="receta_fecha_emision" class="form-control" value="{{ $receta->fecha_emision->format('Y-m-d') }}">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Advertencias Generales</label>
                    <textarea name="receta_advertencias" class="form-control" rows="2">{{ $receta->advertencias }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Signos de Alarma</label>
                    <textarea name="receta_signos_alarma" class="form-control" rows="2">{{ $receta->signos_alarma }}</textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Recomendaciones no farmacológicas</label>
                    <textarea name="receta_recomendaciones_no_farmacologicas" class="form-control" rows="2">{{ $receta->recomendaciones_no_farmacologicas }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Receta
                </button>
                <a href="{{ route('historial.show', $receta->historial_clinico_id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let medicamentoIndex = {{ count($medicamentos) }};

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
                    <input type="text" name="receta_medicamentos[${newIndex}][medicamento]" class="form-control form-control-sm" placeholder="Ej: Paracetamol">
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
                    <label class="form-label fw-semibold">Dosis</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][dosis]" class="form-control form-control-sm" placeholder="Ej: 1 tableta">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Frecuencia</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][frecuencia]" class="form-control form-control-sm" placeholder="Ej: Cada 8 horas">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Duración</label>
                    <input type="text" name="receta_medicamentos[${newIndex}][duracion]" class="form-control form-control-sm" placeholder="Ej: 7 días">
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
            // Actualizar nombres de inputs Y selects
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