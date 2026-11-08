@extends('layouts.app')

@section('title', 'Nuevo Historial Clínico')
<div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <div>
        <i class="fas fa-file-medical me-2 text-primary"></i> 
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
        @include('historial.partials._estudios-complementarios')
<!-- ========== DIAGNÓSTICOS ========== -->
        @include('historial.partials._diagnosticos')
        <!-- ========== TRATAMIENTO Y RECOMENDACIONES ========== -->
        @include('historial.partials._tratamiento')
        <!-- ========== OBSERVACIONES ========== -->
        @include('historial.partials._observaciones')
        <!-- BOTONES -->
                @include('historial.partials._botones-accion')
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // CIE-10 (BÚSQUEDA Y AUTOCOMPLETADO)
    // ============================================
    const cie10SearchUrl = '{{ route("cie10.search") }}';
    const cie10ByDiagnosticoUrl = '{{ route("cie10.by-diagnostico") }}';

    function configurarFila(row) {
        const cie10Input = row.querySelector('.cie10-input');
        const diagnosticoText = row.querySelector('.diagnostico-text');
        const clearBtn = row.querySelector('.clear-cie10-row');

        if (!cie10Input) return;

        const index = cie10Input.dataset.index;
        const resultsContainerId = 'cie10-results-' + index;
        let resultsContainer = document.getElementById(resultsContainerId);
        
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

        function buscar(term) {
            if (term.length < 1) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                return;
            }

            const cleanTerm = term.replace(/\./g, '');

            fetch(cie10SearchUrl + '?q=' + encodeURIComponent(cleanTerm))
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';
                    
                    if (data.length > 0) {
                        resultsContainer.style.display = 'block';
                        data.forEach((item) => {
                            const div = document.createElement('div');
                            div.className = 'cie10-results-item';
                            div.innerHTML = `
                                <span class="cie10-code">${item.codigo}</span>
                                <span class="cie10-desc">${item.diagnostico}</span>
                            `;
                            div.dataset.codigo = item.codigo;
                            div.dataset.diagnostico = item.diagnostico;
                            
                            div.addEventListener('click', function(e) {
                                e.stopPropagation();
                                cie10Input.value = this.dataset.codigo;
                                if (diagnosticoText) {
                                    diagnosticoText.value = this.dataset.diagnostico;
                                }
                                resultsContainer.style.display = 'none';
                                resultsContainer.innerHTML = '';
                                cie10Input.focus();
                            });
                            
                            resultsContainer.appendChild(div);
                        });
                    } else {
                        resultsContainer.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error CIE-10:', error);
                    resultsContainer.style.display = 'none';
                });
        }

        cie10Input.addEventListener('input', function() {
            const term = this.value.trim();
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                buscar(term);
            }, 200);
        });

        if (diagnosticoText) {
            let diagnosticoTimeout;
            diagnosticoText.addEventListener('input', function() {
                const term = this.value.trim();
                clearTimeout(diagnosticoTimeout);
                if (term.length < 2) return;
                diagnosticoTimeout = setTimeout(function() {
                    fetch(cie10ByDiagnosticoUrl + '?diagnostico=' + encodeURIComponent(term))
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.codigo) {
                                cie10Input.value = data.codigo;
                                buscar(term);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }, 300);
            });
        }

        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                cie10Input.value = '';
                if (diagnosticoText) diagnosticoText.value = '';
                resultsContainer.innerHTML = '';
                resultsContainer.style.display = 'none';
                cie10Input.focus();
            });
        }

        document.addEventListener('click', function(e) {
            if (!row.contains(e.target)) {
                resultsContainer.style.display = 'none';
            }
        });
    }

    document.querySelectorAll('.diagnostico-row').forEach(function(row) {
        configurarFila(row);
    });

    // Botón de agregar diagnóstico
    document.getElementById('agregar-diagnostico')?.addEventListener('click', function() {
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
                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" title="Limpiar"><i class="fas fa-times"></i></button>
                </div>
            </td>
            <td>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="diagnosticos[${newIndex}][tipo]" value="PRE" checked>
                    <label class="form-check-label">PRE</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="diagnosticos[${newIndex}][tipo]" value="DEF">
                    <label class="form-check-label">DEF</label>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico"><i class="fas fa-times"></i></button>
            </td>
        `;
        
        tbody.appendChild(tr);
        configurarFila(tr);
    });

    // Eliminar diagnóstico
    document.getElementById('diagnosticos-body')?.addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-diagnostico')) {
            const btn = e.target.closest('.eliminar-diagnostico');
            const row = btn.closest('.diagnostico-row');
            if (document.querySelectorAll('.diagnostico-row').length > 1) {
                row.remove();
            }
        }
    });
});
</script>
@endpush
@push('scripts')
    @include('historial.partials._scripts')
@endpush
@include('historial.partials._scripts-receta')
    <script>
        window.cie10SearchUrl = '{{ route("cie10.search") }}';
        window.cie10ByDiagnosticoUrl = '{{ route("cie10.by-diagnostico") }}';
    </script>
