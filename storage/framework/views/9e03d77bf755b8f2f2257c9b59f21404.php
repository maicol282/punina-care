<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-pills me-2 text-primary"></i> Tratamiento y Recomendaciones
        </div>
        <div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="generarReceta" name="generar_receta" value="1" style="width: 40px; height: 20px;">
                <label class="form-check-label fw-semibold text-success" for="generarReceta">
                    <i class="fas fa-prescription me-1"></i> Generar Receta Médica
                </label>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label fw-semibold">Tratamiento</label>
            <textarea name="tratamiento" id="tratamiento" class="form-control" rows="3" placeholder="Indicaciones médicas, medicamentos, procedimientos..."></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Recomendaciones</label>
            <textarea name="recomendaciones" id="recomendaciones" class="form-control" rows="3" placeholder="Recomendaciones para el paciente..."></textarea>
        </div>

        <!-- ===== RECETA MÉDICA (se muestra solo si se activa) ===== -->
<div id="recetaContainer" style="display: none;">
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="fw-bold text-primary">
            <i class="fas fa-prescription me-2"></i> Datos de la Receta Médica
            <span class="badge bg-info ms-2">Se genera automáticamente desde el tratamiento</span>
        </h6>
        <button type="button" class="btn btn-sm btn-success" id="agregarMedicamento">
            <i class="fas fa-plus me-1"></i> Agregar Medicamento
        </button>
    </div>
    
    <div id="medicamentosContainer" class="mt-3">
        <!-- Fila de medicamento 1 (por defecto) -->
        <div class="medicamento-row border rounded-3 p-3 mb-3" style="background: #f8faff; border-color: #e0e7ff !important;" data-index="0">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="fw-semibold text-primary">Medicamento #1</span>
                <button type="button" class="btn btn-sm btn-danger eliminar-medicamento" style="display: none;">
                    <i class="fas fa-times me-1"></i> Eliminar
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                    <input type="text" name="receta_medicamentos[0][medicamento]" class="form-control form-control-sm medicamento-input" placeholder="Ej: Paracetamol">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Presentación</label>
                    <input type="text" name="receta_medicamentos[0][presentacion]" class="form-control form-control-sm" placeholder="Ej: Tabletas">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Concentración</label>
                    <input type="text" name="receta_medicamentos[0][concentracion]" class="form-control form-control-sm" placeholder="Ej: 500mg">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Dosis</label>
                    <input type="text" name="receta_medicamentos[0][dosis]" class="form-control form-control-sm" placeholder="Ej: 1 tableta">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Frecuencia</label>
                    <input type="text" name="receta_medicamentos[0][frecuencia]" class="form-control form-control-sm" placeholder="Ej: Cada 8 horas">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Duración</label>
                    <input type="text" name="receta_medicamentos[0][duracion]" class="form-control form-control-sm" placeholder="Ej: 7 días">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Indicaciones específicas</label>
                    <input type="text" name="receta_medicamentos[0][indicaciones]" class="form-control form-control-sm" placeholder="Instrucciones para este medicamento...">
                </div>
            </div>
        </div>
    </div>

    <!-- Campos generales de la receta -->
    <div class="row g-3 mt-2">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Fecha de Emisión</label>
            <input type="date" name="receta_fecha_emision" id="receta_fecha_emision" class="form-control" value="<?php echo e(date('Y-m-d')); ?>">
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Advertencias</label>
            <textarea name="receta_advertencias" id="receta_advertencias" class="form-control" rows="2" placeholder="Advertencias importantes..."></textarea>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Signos de Alarma</label>
            <textarea name="receta_signos_alarma" id="receta_signos_alarma" class="form-control" rows="2" placeholder="Signos que requieren atención médica inmediata..."></textarea>
        </div>
        <div class="col-12">
            <label class="form-label fw-semibold">Recomendaciones no farmacológicas</label>
            <textarea name="receta_recomendaciones_no_farmacologicas" id="receta_recomendaciones_no_farmacologicas" class="form-control" rows="2" placeholder="Ejercicio, dieta, hidratación..."></textarea>
        </div>
    </div>
</div>
    </div>
</div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/_tratamiento.blade.php ENDPATH**/ ?>