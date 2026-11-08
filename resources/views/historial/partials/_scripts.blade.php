<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // 1. CALCULAR EDAD GESTACIONAL (Solo si está embarazada)
    // ============================================
    function calcularEdadGestacional() {
        const fmuInput = document.getElementById('fmu');
        const edadGestacionalInput = document.getElementById('edad_gestacional');
        const checkboxEmbarazo = document.getElementById('esta_embarazada');
        
        // Si no hay checkbox o no está marcado, no calcular
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

    // Escuchar cambios en la FUM
    document.getElementById('fmu')?.addEventListener('change', calcularEdadGestacional);
    document.getElementById('fmu')?.addEventListener('input', calcularEdadGestacional);
    
    // Escuchar cambios en el checkbox de embarazo
    document.getElementById('esta_embarazada')?.addEventListener('change', calcularEdadGestacional);

    // Calcular al cargar si ya hay una FUM guardada
    setTimeout(calcularEdadGestacional, 500);


    // ============================================
    // 2. LÓGICA DE PRESIÓN ARTERIAL PEDIÁTRICA
    // ============================================
    const fechaNacimiento = document.getElementById('fecha_nacimiento_paciente')?.value;
    const presionInput = document.getElementById('presion_arterial');
    const btnToggle = document.getElementById('togglePresionBtn');
    const ayuda = document.getElementById('presion_ayuda');

    if (presionInput) {
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
                if (btnToggle) {
                    btnToggle.classList.remove('btn-outline-secondary');
                    btnToggle.classList.add('btn-outline-warning');
                }
            } else {
                presionInput.disabled = false;
                if (presionInput.value === 'N/A (Paciente pediátrico)') {
                    presionInput.value = '';
                }
                if (ayuda) ayuda.textContent = 'Habilitado por defecto';
                if (btnToggle) {
                    btnToggle.classList.remove('btn-outline-warning');
                    btnToggle.classList.add('btn-outline-secondary');
                }
            }
        }

        // Ejecutar al cargar
        configurarPresion();

        // Escuchar cambios en la fecha de nacimiento (si existe)
        const fechaInput = document.getElementById('fecha_nacimiento_paciente');
        if (fechaInput) {
            fechaInput.addEventListener('change', configurarPresion);
            fechaInput.addEventListener('input', configurarPresion);
        }

        // Botón para habilitar/deshabilitar manualmente
        if (btnToggle) {
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
    }
});
</script>

// ============================================
// EXPLORACIÓN FÍSICA - SP / CP (CREATE)
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

    // Verificar estado inicial
    if (radio.value === 'CP' && radio.checked && textarea) {
        textarea.style.display = 'block';
    }
});

// ============================================
// ANTECEDENTES PATOLÓGICOS (toggle-patologico)
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
