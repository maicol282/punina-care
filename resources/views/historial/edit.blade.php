@extends('layouts.app')

@section('title', 'Editar Historial Clínico')
@section('page-title', 'Editar Historial Clínico')

@section('content')
<div class="container-fluid px-0">
    <!-- Información del paciente -->
       @include('historial.partials.edit._info-paciente')
    

    <form action="{{ route('historial.update', $historial->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ========== DATOS DE LA CONSULTA ========== -->
        @include('historial.partials.edit._datos-consulta')

        

        <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
        @include('historial.partials.edit._antecedentes-patologicos')

        <!-- ========== ANTECEDENTES PERSONALES NO PATOLÓGICOS ========== -->
      @include('historial.partials.edit._antecedentes-no-patologicos')

        <!-- ========== ANTECEDENTES FAMILIARES ========== -->
        @include('historial.partials.edit._antecedentes-familiares')

        <!-- ========== GINECO OBSTÉTRICOS ========== -->
              @include('historial.partials.edit._gineco-obstetricos')
         <!-- ========== ENFERMEDAD ACTUAL ========== -->
                @include('historial.partials.edit._enfermedad-actual')


        <!-- ========== SIGNOS VITALES ========== -->
        @include('historial.partials.edit._signos-vitales')
        <!-- ========== EXPLORACIÓN FÍSICA ========== -->
        @include('historial.partials.edit._exploracion-fisica')

        <!-- ========== REVISIÓN DE ÓRGANOS Y SISTEMAS ========== -->
        @include('historial.partials.edit._revision-sistemas')

      <!-- ========== ESTUDIOS COMPLEMENTARIOS ========== -->
        @include('historial.partials.edit._estudios-complementarios')<!-- ========== DIAGNÓSTICOS ========== -->
<div class="card mb-4 shadow-sm">
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
                    @forelse($historial->diagnosticos as $index => $diag)
                        <tr class="diagnostico-row">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <textarea name="diagnosticos[{{ $index }}][descripcion]" class="form-control diagnostico-autocomplete" rows="2" placeholder="Escriba el diagnóstico..." data-index="{{ $index }}">{{ old("diagnosticos.{$index}.descripcion", $diag->descripcion) }}</textarea>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="diagnosticos[{{ $index }}][cie10]" id="cie10_{{ $index }}" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" value="{{ old("diagnosticos.{$index}.cie10", $diag->cie10_code) }}" data-index="{{ $index }}">
                                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="{{ $index }}" title="Limpiar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div id="cie10-results-{{ $index }}" class="cie10-results" style="display: none;"></div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[{{ $index }}][tipo]" value="PRE" {{ old("diagnosticos.{$index}.tipo", $diag->tipo) == 'PRE' ? 'checked' : '' }}>
                                        <label class="form-check-label">PRE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[{{ $index }}][tipo]" value="DEF" {{ old("diagnosticos.{$index}.tipo", $diag->tipo) == 'DEF' ? 'checked' : '' }}>
                                        <label class="form-check-label">DEF</label>
                                    </div>
                                </div>
                                <input type="hidden" name="diagnosticos[{{ $index }}][id]" value="{{ $diag->id }}">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico" {{ $historial->diagnosticos->count() <= 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="diagnostico-row">
                            <td class="text-center">1</td>
                            <td>
                                <textarea name="diagnosticos[0][descripcion]" class="form-control diagnostico-autocomplete" rows="1" placeholder="Escriba el diagnóstico..." data-index="0"></textarea>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="diagnosticos[0][cie10]" id="cie10_0" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" data-index="0">
                                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="0" title="Limpiar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
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
                    @endforelse
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
            <div class="card-header bg-white py-3">
                <i class="fas fa-pills me-2 text-primary"></i> Tratamiento y Recomendaciones
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tratamiento</label>
                    <textarea name="tratamiento" class="form-control" rows="3" placeholder="Indicaciones médicas, medicamentos, procedimientos...">{{ old('tratamiento', $historial->tratamiento) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Recomendaciones</label>
                    <textarea name="recomendaciones" class="form-control" rows="3" placeholder="Recomendaciones para el paciente...">{{ old('recomendaciones', $historial->recomendaciones) }}</textarea>
                </div>
            </div>
        </div>

        <!-- ========== OBSERVACIONES ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-comment me-2 text-primary"></i> Observaciones
            </div>
            <div class="card-body">
                <textarea name="observaciones" class="form-control" rows="2" placeholder="Observaciones adicionales...">{{ old('observaciones', $historial->observaciones) }}</textarea>
            </div>
        </div>

        <!-- ========== BOTONES ========== -->
        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('pacientes.show', $historial->paciente->id) }}" class="btn btn-secondary px-4 py-2">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary px-5 py-2">
                <i class="fas fa-save me-2"></i> Actualizar Historial
            </button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<style>
.cie10-results {
    background: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    max-height: 250px;
    overflow-y: auto;
    z-index: 9999;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-top: 2px;
    position: absolute;
    width: 90%;
}
.cie10-results-item {
    padding: 8px 12px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
    font-size: 13px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.cie10-results-item:hover {
    background: #007bff;
    color: white;
}
.cie10-results-item .cie10-code {
    font-weight: bold;
    background: #e9ecef;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 12px;
    min-width: 60px;
    text-align: center;
}
.cie10-results-item:hover .cie10-code {
    background: #0056b3;
    color: white;
}
.cie10-results-item .cie10-desc {
    flex: 1;
    margin-left: 10px;
}
.cie10-results-item:hover .cie10-desc {
    color: white;
}
.selected {
    background: #007bff !important;
    color: white !important;
}
.selected .cie10-code {
    background: #0056b3 !important;
    color: white !important;
}
.selected .cie10-desc {
    color: white !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cie10SearchUrl = '{{ route("cie10.search") }}';
    const cie10ByDiagnosticoUrl = '{{ route("cie10.by-diagnostico") }}';

    function configurarFila(row) {
        const cie10Input = row.querySelector('.cie10-input');
        const diagnosticoText = row.querySelector('.diagnostico-autocomplete');
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
        let selectedIndex = -1;
        let currentResults = [];

        function buscar(term) {
            if (term.length < 1) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                currentResults = [];
                selectedIndex = -1;
                return;
            }

            const cleanTerm = term.replace(/\./g, '');

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
                        resultsContainer.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsContainer.style.display = 'none';
                });
        }

        // ============================================
        // EVENTO: Escribir en código CIE-10
        // ============================================
        cie10Input.addEventListener('input', function() {
            const term = this.value.trim();
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                buscar(term);
            }, 200);
        });

        // ============================================
        // EVENTO: Escribir en diagnóstico (bidireccional)
        // ============================================
        if (diagnosticoText) {
            let diagnosticoTimeout;
            
            diagnosticoText.addEventListener('input', function() {
                const term = this.value.trim();
                clearTimeout(diagnosticoTimeout);
                
                if (term.length < 2) {
                    return;
                }

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

        // ============================================
        // TECLAS DE NAVEGACIÓN
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
                } else {
                    const val = this.value.trim();
                    if (val.length >= 1) {
                        const cleanVal = val.replace(/\./g, '');
                        fetch(cie10SearchUrl + '?q=' + encodeURIComponent(cleanVal))
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    const item = data[0];
                                    cie10Input.value = item.codigo;
                                    if (diagnosticoText) {
                                        diagnosticoText.value = item.diagnostico;
                                    }
                                    resultsContainer.style.display = 'none';
                                    resultsContainer.innerHTML = '';
                                    currentResults = [];
                                    selectedIndex = -1;
                                }
                            });
                    }
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
        // OCULTAR RESULTADOS
        // ============================================
        cie10Input.addEventListener('blur', function() {
            setTimeout(function() {
                resultsContainer.style.display = 'none';
            }, 300);
        });

        // ============================================
        // BOTÓN LIMPIAR
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

        // Click fuera para cerrar
        document.addEventListener('click', function(e) {
            if (!row.contains(e.target)) {
                resultsContainer.style.display = 'none';
            }
        });
    }

    // ============================================
    // CONFIGURAR FILAS EXISTENTES
    // ============================================
    document.querySelectorAll('.diagnostico-row').forEach(function(row) {
        configurarFila(row);
    });

    // ============================================
    // AGREGAR NUEVA FILA
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
                <textarea name="diagnosticos[${newIndex}][descripcion]" class="form-control diagnostico-autocomplete" rows="1" placeholder="Escriba el diagnóstico..." data-index="${newIndex}"></textarea>
            </td>
            <td style="position: relative;">
                <div class="input-group">
                    <input type="text" name="diagnosticos[${newIndex}][cie10]" id="cie10_${newIndex}" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" data-index="${newIndex}">
                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="${newIndex}" title="Limpiar">
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

    function actualizarNumeros() {
        document.querySelectorAll('.diagnostico-row').forEach((row, index) => {
            row.querySelector('td:first-child').textContent = index + 1;
        });
    }

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
// CONFIGURAR DROP ZONES EN EDIT
// ============================================
function configurarDropZoneEdit(zoneClass, inputClass, listClass, countClass, categoria) {
    const dropZone = document.querySelector(zoneClass);
    const fileInput = document.querySelector(inputClass);
    const fileList = document.querySelector(listClass);
    const countBadge = document.getElementById(countClass);
    let archivos = [];

    if (!dropZone || !fileInput) return;

    // Click
    dropZone.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.click();
    });

    // Drag and drop
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
            agregarArchivosEdit(files, archivos, fileList, countBadge, categoria);
        }
    });

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            agregarArchivosEdit(this.files, archivos, fileList, countBadge, categoria);
        }
        this.value = '';
    });

    // Actualizar contador inicial
    if (countBadge) {
        const existingFiles = fileList.querySelectorAll('.border').length;
        const count = parseInt(countBadge.textContent) || 0;
        if (count === 0 && existingFiles === 0) {
            countBadge.textContent = '0 archivos';
        }
    }

    return {
        getArchivos: function() { return archivos; },
        limpiar: function() { archivos = []; fileList.innerHTML = ''; if (countBadge) countBadge.textContent = '0 archivos'; }
    };
}

function agregarArchivosEdit(files, archivosArray, fileList, countBadge, categoria) {
    const maxSize = 10 * 1024 * 1024;
    const formatosPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 
                                 'application/pdf', 'application/msword', 
                                 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                 'application/vnd.ms-excel', 
                                 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    for (let file of files) {
        if (file.size > maxSize) {
            mostrarAlertaEdit(`❌ ${file.name} excede 10MB`, 'danger');
            continue;
        }
        if (!formatosPermitidos.includes(file.type)) {
            mostrarAlertaEdit(`❌ ${file.name} formato no permitido`, 'danger');
            continue;
        }
        const existe = archivosArray.some(a => a.name === file.name && a.size === file.size);
        if (!existe) {
            archivosArray.push(file);
        }
    }
    renderizarArchivosEdit(archivosArray, fileList, countBadge, categoria);
}

function renderizarArchivosEdit(archivosArray, fileList, countBadge, categoria) {
    if (archivosArray.length === 0) {
        fileList.innerHTML = '';
        if (countBadge) {
            const existing = fileList.parentElement.querySelectorAll('.border').length;
            countBadge.textContent = existing + ' archivos';
        }
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
// ELIMINAR ARCHIVOS EXISTENTES EN EDIT
// ============================================
document.querySelectorAll('.eliminar-archivo-edit').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const contenedor = document.getElementById('archivo-edit-' + id);
        if (contenedor && confirm('¿Eliminar este archivo?')) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'eliminar_archivos[]';
            input.value = id;
            document.querySelector('form').appendChild(input);
            contenedor.style.display = 'none';
            
            // Actualizar contador de la categoría
            const categoria = contenedor.closest('.col-md-7').previousElementSibling.querySelector('.badge');
            if (categoria) {
                const count = parseInt(categoria.textContent) || 0;
                categoria.textContent = Math.max(0, count - 1) + ' archivos';
            }
        }
    });
});

// ============================================
// INICIALIZAR DROP ZONES EN EDIT
// ============================================
configurarDropZoneEdit('.drop-zone-laboratorio-edit', '.file-input-laboratorio-edit', '.file-list-laboratorio-edit', 'count-laboratorio-edit', 'laboratorio');
configurarDropZoneEdit('.drop-zone-imagen-edit', '.file-input-imagen-edit', '.file-list-imagen-edit', 'count-imagen-edit', 'imagen');
configurarDropZoneEdit('.drop-zone-otros-edit', '.file-input-otros-edit', '.file-list-otros-edit', 'count-otros-edit', 'otros');

// ============================================
// TOGGLE CONTRAER/EXPANDIR EN EDIT
// ============================================
document.getElementById('toggleEstudiosEdit')?.addEventListener('click', function() {
    const container = document.getElementById('estudiosContainerEdit');
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

function mostrarAlertaEdit(mensaje, tipo = 'danger') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show py-1 px-2 mb-1`;
    alerta.role = 'alert';
    alerta.style.fontSize = '12px';
    alerta.innerHTML = `${mensaje} <button type="button" class="btn-close p-1" data-bs-dismiss="alert" style="font-size: 10px;"></button>`;
    const container = document.querySelector('#estudiosContainerEdit');
    if (container) {
        container.prepend(alerta);
        setTimeout(() => alerta.remove(), 4000);
    }
}
// ============================================
// TOGGLE PARA SISTEMAS EN EDIT
// ============================================
document.querySelectorAll('.sistema-toggle-edit').forEach(function(checkbox) {
    const targetId = checkbox.dataset.target;
    const textarea = document.getElementById(targetId);
    
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
// TOGGLE PARA SISTEMAS EN EDIT - SP / CP
// ============================================
document.querySelectorAll('.sistema-radio-edit').forEach(function(radio) {
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
});

// ============================================
// TOGGLE CONTRAER/EXPANDIR EN EDIT
// ============================================
document.getElementById('toggleSistemasEdit')?.addEventListener('click', function() {
    const container = document.getElementById('sistemasContainerEdit');
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
//-------------------------------------
// ============================================
// TOGGLE PARA EXPLORACIÓN FÍSICA - SP / CP
// ============================================
// Para CREATE
document.querySelectorAll('.exploracion-radio').forEach(function(radio) {
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

    // Verificar estado inicial
    if (radio.value === 'CP' && radio.checked && textarea) {
        textarea.style.display = 'block';
    }
});

// Para EDIT
document.querySelectorAll('.exploracion-radio-edit').forEach(function(radio) {
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
});
</script>
@endpush