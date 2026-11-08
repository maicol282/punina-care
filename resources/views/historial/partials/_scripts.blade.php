<script>
document.addEventListener('DOMContentLoaded', function() {

    // ============================================
    // 1. CALCULAR MASA CORPORAL (IMC)
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

    document.getElementById('peso')?.addEventListener('input', calcularIMC);
    document.getElementById('altura')?.addEventListener('input', calcularIMC);
    setTimeout(calcularIMC, 500); // Calcular al cargar por si ya hay datos

    // ============================================
    // 2. CALCULAR EDAD GESTACIONAL
    // ============================================
    function calcularEdadGestacional() {
        const fmuInput = document.getElementById('fmu');
        const edadGestacionalInput = document.getElementById('edad_gestacional');
        const checkboxEmbarazo = document.getElementById('esta_embarazada');
        
        if (!checkboxEmbarazo || !checkboxEmbarazo.checked) {
            if (edadGestacionalInput) edadGestacionalInput.value = '';
            return;
        }
        
        if (!fmuInput || !edadGestacionalInput) return;
        
        const fmu = new Date(fmuInput.value);
        const hoy = new Date();
        
        if (isNaN(fmu.getTime())) {
            edadGestacionalInput.value = '';
            return;
        }
        
        if (fmu > hoy) {
            edadGestacionalInput.value = 'Fecha futura inválida';
            return;
        }
        
        const diffTime = hoy - fmu;
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        const semanas = Math.floor(diffDays / 7);
        const dias = diffDays % 7;
        
        edadGestacionalInput.value = semanas + ' semanas y ' + dias + ' días';
    }

    document.getElementById('fmu')?.addEventListener('change', calcularEdadGestacional);
    document.getElementById('fmu')?.addEventListener('input', calcularEdadGestacional);
    document.getElementById('esta_embarazada')?.addEventListener('change', calcularEdadGestacional);
    setTimeout(calcularEdadGestacional, 500);

    // ============================================
    // 3. PRESIÓN ARTERIAL PEDIÁTRICA (HABILITAR/DESHABILITAR)
    // ============================================
    const fechaNacimiento = document.getElementById('fecha_nacimiento_paciente')?.value;
    const presionInput = document.getElementById('presion_arterial');
    const btnToggle = document.getElementById('togglePresionBtn');
    const ayuda = document.getElementById('presion_ayuda');

    if (presionInput && btnToggle) {
        function calcularEdad(fecha) {
            if (!fecha) return 0;
            const hoy = new Date();
            const nacimiento = new Date(fecha);
            let edad = hoy.getFullYear() - nacimiento.getFullYear();
            const mes = hoy.getMonth() - nacimiento.getMonth();
            if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
                edad--;
            }
            return edad;
        }

        function configurarPresion() {
            const edad = calcularEdad(fechaNacimiento);
            if (edad > 0 && edad < 15) {
                presionInput.disabled = true;
                presionInput.value = 'N/A (Paciente pediátrico)';
                if (ayuda) ayuda.textContent = 'Presión deshabilitada (niño). Use el botón para habilitar.';
                btnToggle.classList.remove('btn-outline-secondary');
                btnToggle.classList.add('btn-outline-warning');
            } else {
                presionInput.disabled = false;
                if (presionInput.value === 'N/A (Paciente pediátrico)') {
                    presionInput.value = '';
                }
                if (ayuda) ayuda.textContent = 'Habilitado por defecto';
                btnToggle.classList.remove('btn-outline-warning');
                btnToggle.classList.add('btn-outline-secondary');
            }
        }

        configurarPresion();

        // Lógica del botón (habilitar/deshabilitar manual)
        btnToggle.addEventListener('click', function() {
            if (presionInput.disabled) {
                presionInput.disabled = false;
                presionInput.value = '';
                presionInput.focus();
                if (ayuda) ayuda.textContent = 'Presión habilitada manualmente.';
                this.classList.remove('btn-outline-warning');
                this.classList.add('btn-outline-success');
            } else {
                presionInput.disabled = true;
                presionInput.value = 'N/A (Paciente pediátrico)';
                if (ayuda) ayuda.textContent = 'Presión deshabilitada manualmente.';
                this.classList.remove('btn-outline-success');
                this.classList.add('btn-outline-warning');
            }
        });
    }

    // ============================================
    // 4. EXPLORACIÓN FÍSICA (SP / CP)
    // ============================================
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
        if (radio.value === 'CP' && radio.checked && textarea) {
            textarea.style.display = 'block';
        }
    });

    // ============================================
    // 5. REVISIÓN DE ÓRGANOS Y SISTEMAS (SP / CP)
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
        if (radio.value === 'CP' && radio.checked && textarea) {
            textarea.style.display = 'block';
        }
    });

    // ============================================
    // 6. ANTECEDENTES PATOLÓGICOS (toggle-patologico)
    // ============================================
    document.querySelectorAll('.toggle-patologico').forEach(function(checkbox) {
        const targetId = checkbox.dataset.target;
        const textarea = document.getElementById(targetId);
        
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
    // 7. CIE-10 (BÚSQUEDA Y AUTOCOMPLETADO)
    // ============================================
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


});
</script>
