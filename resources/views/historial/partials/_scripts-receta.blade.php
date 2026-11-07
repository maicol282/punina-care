<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // LÓGICA DE GENERACIÓN DE RECETA
    // ============================================
    const generarRecetaCheckbox = document.getElementById('generarReceta');
    const recetaContainer = document.getElementById('recetaContainer');

    if (!generarRecetaCheckbox || !recetaContainer) {
        console.warn('No se encontró el checkbox o el contenedor de la receta.');
        return;
    }

    // Mostrar/ocultar el contenedor según el checkbox
    generarRecetaCheckbox.addEventListener('change', function() {
        if (this.checked) {
            recetaContainer.style.display = 'block';
            // Scroll suave hacia la receta
            setTimeout(() => {
                recetaContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        } else {
            recetaContainer.style.display = 'none';
        }
    });

    // Estado inicial (por si acaso el checkbox ya está marcado al cargar)
    if (generarRecetaCheckbox.checked) {
        recetaContainer.style.display = 'block';
    } else {
        recetaContainer.style.display = 'none';
    }

    // ============================================
    // AGREGAR MEDICAMENTO (si existe el botón)
    // ============================================
    const btnAgregarMedicamento = document.getElementById('agregarMedicamento');
    const medicamentosContainer = document.getElementById('medicamentosContainer');
    
    if (btnAgregarMedicamento && medicamentosContainer) {
        let medicamentoIndex = 1;

        btnAgregarMedicamento.addEventListener('click', function() {
            const newIndex = medicamentoIndex++;
            
            const row = document.createElement('div');
            row.className = 'medicamento-row border rounded-3 p-3 mb-3';
            row.style.cssText = 'background: #f8faff; border-color: #e0e7ff !important;';
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
                        <input type="text" name="receta_medicamentos[${newIndex}][medicamento]" class="form-control form-control-sm medicamento-input" placeholder="Ej: Paracetamol">
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
            
            medicamentosContainer.appendChild(row);
            actualizarBotonesEliminar();
        });

        // Eliminar medicamento
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
    }
});
</script>
