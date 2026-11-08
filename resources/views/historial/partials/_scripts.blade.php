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
    setTimeout(calcularIMC, 500);

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
    // 3. PRESIÓN ARTERIAL PEDIÁTRICA
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

        // Lógica del botón (alternar habilitar/deshabilitar)
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

});
</script>
