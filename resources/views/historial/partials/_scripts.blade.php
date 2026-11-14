<script>
document.addEventListener('DOMContentLoaded', function() {

    // ============================================
    // 1. CIE-10 (BÚSQUEDA Y AUTOCOMPLETADO) - DIAGNÓSTICOS
    // ============================================
    const cie10SearchUrl = window.cie10SearchUrl || '/cie10/search';
    const cie10ByDiagnosticoUrl = window.cie10ByDiagnosticoUrl || '/cie10/by-diagnostico';

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

    document.getElementById('diagnosticos-body')?.addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-diagnostico')) {
            const btn = e.target.closest('.eliminar-diagnostico');
            const row = btn.closest('.diagnostico-row');
            if (document.querySelectorAll('.diagnostico-row').length > 1) {
                row.remove();
            }
        }
    });

    // ============================================
    // 2. PRESIÓN ARTERIAL PEDIÁTRICA (BOTÓN)
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

        function actualizarEstadoBoton() {
            if (presionInput.disabled) {
                btnToggle.innerHTML = '<i class="fas fa-lock-open me-1"></i> Habilitar';
                btnToggle.classList.remove('btn-outline-secondary', 'btn-outline-warning');
                btnToggle.classList.add('btn-outline-success');
                if (ayuda) ayuda.textContent = 'Presión deshabilitada. Use el botón para habilitar.';
            } else {
                btnToggle.innerHTML = '<i class="fas fa-lock me-1"></i> Deshabilitar';
                btnToggle.classList.remove('btn-outline-success');
                btnToggle.classList.add('btn-outline-warning');
                if (ayuda) ayuda.textContent = 'Presión habilitada. Use el botón para deshabilitar.';
            }
        }

        function configurarPresion() {
            const edad = calcularEdad(fechaNacimiento);
            if (edad > 0 && edad < 15) {
                presionInput.setAttribute('disabled', 'disabled');
                presionInput.value = 'N/A (Paciente pediátrico)';
            } else {
                presionInput.removeAttribute('disabled');
                if (presionInput.value === 'N/A (Paciente pediátrico)') {
                    presionInput.value = '';
                }
            }
            actualizarEstadoBoton();
        }

        configurarPresion();

        btnToggle.addEventListener('click', function() {
            if (presionInput.hasAttribute('disabled')) {
                presionInput.removeAttribute('disabled');
                presionInput.value = '';
                presionInput.focus();
            } else {
                presionInput.setAttribute('disabled', 'disabled');
                presionInput.value = 'N/A (Paciente pediátrico)';
            }
            actualizarEstadoBoton();
        });
    }

    // ============================================
    // 3. CALCULAR MASA CORPORAL (IMC)
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
    setTimeout(calcularIMC, 500);

    // ============================================
    // 4. EXPLORACIÓN FÍSICA Y SISTEMAS (SP / CP)
    // ============================================
    document.querySelectorAll('.exploracion-radio, .sistema-radio').forEach(function(radio) {
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
    // 5. ANTECEDENTES PATOLÓGICOS (toggles)
    // ============================================
    document.querySelectorAll('.toggle-patologico').forEach(function(checkbox) {
        const targetId = checkbox.dataset.target;
        const textarea = document.getElementById(targetId);
        if (checkbox.checked && textarea) textarea.style.display = 'block';
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
    // 6. DROPZONES (SUBIDA DE ARCHIVOS)
    // ============================================
    document.querySelectorAll('.drop-zone-laboratorio, .drop-zone-imagen, .drop-zone-otros').forEach(function(zone) {
        zone.addEventListener('click', function() {
            const input = this.querySelector('input[type="file"]');
            if (input) input.click();
        });
    });

});
</script>
