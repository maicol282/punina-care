

<?php $__env->startSection('title', 'Editar Receta Médica'); ?>
<?php $__env->startSection('page-title', 'Editar Receta Médica'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-prescription me-2 text-primary"></i>
            Editar Receta Médica
        </h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('recetas.update', $receta)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php
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
            ?>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-primary mb-0">
                    <i class="fas fa-prescription me-2"></i> Medicamentos
                </h6>
                <button type="button" class="btn btn-sm btn-success" id="agregarMedicamento">
                    <i class="fas fa-plus me-1"></i> Agregar Medicamento
                </button>
            </div>
            
            <div id="medicamentosContainer">
                <?php $__currentLoopData = $medicamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="medicamento-row border rounded-3 p-3 mb-3" style="background: #f8faff;" data-index="<?php echo e($index); ?>">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold text-primary">Medicamento #<?php echo e($index + 1); ?></span>
                        <button type="button" class="btn btn-sm btn-danger eliminar-medicamento" <?php echo e(count($medicamentos) <= 1 ? 'disabled' : ''); ?>>
                            <i class="fas fa-times me-1"></i> Eliminar
                        </button>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Medicamento <span class="text-danger">*</span></label>
                            <input type="text" name="receta_medicamentos[<?php echo e($index); ?>][medicamento]" class="form-control form-control-sm" value="<?php echo e($med['medicamento'] ?? ''); ?>" placeholder="Ej: Paracetamol">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Presentación</label>
                            <input type="text" name="receta_medicamentos[<?php echo e($index); ?>][presentacion]" class="form-control form-control-sm" value="<?php echo e($med['presentacion'] ?? ''); ?>" placeholder="Ej: Tabletas">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Concentración</label>
                            <input type="text" name="receta_medicamentos[<?php echo e($index); ?>][concentracion]" class="form-control form-control-sm" value="<?php echo e($med['concentracion'] ?? ''); ?>" placeholder="Ej: 500mg">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Dosis</label>
                            <input type="text" name="receta_medicamentos[<?php echo e($index); ?>][dosis]" class="form-control form-control-sm" value="<?php echo e($med['dosis'] ?? ''); ?>" placeholder="Ej: 1 tableta">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Frecuencia</label>
                            <input type="text" name="receta_medicamentos[<?php echo e($index); ?>][frecuencia]" class="form-control form-control-sm" value="<?php echo e($med['frecuencia'] ?? ''); ?>" placeholder="Ej: Cada 8 horas">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Duración</label>
                            <input type="text" name="receta_medicamentos[<?php echo e($index); ?>][duracion]" class="form-control form-control-sm" value="<?php echo e($med['duracion'] ?? ''); ?>" placeholder="Ej: 7 días">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Indicaciones específicas</label>
                            <input type="text" name="receta_medicamentos[<?php echo e($index); ?>][indicaciones]" class="form-control form-control-sm" value="<?php echo e($med['indicaciones'] ?? ''); ?>" placeholder="Instrucciones para este medicamento...">
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Campos generales de la receta -->
            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Fecha de Emisión</label>
                    <input type="date" name="receta_fecha_emision" class="form-control" value="<?php echo e($receta->fecha_emision->format('Y-m-d')); ?>">
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Advertencias</label>
                    <textarea name="receta_advertencias" class="form-control" rows="2"><?php echo e($receta->advertencias); ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Signos de Alarma</label>
                    <textarea name="receta_signos_alarma" class="form-control" rows="2"><?php echo e($receta->signos_alarma); ?></textarea>
                </div>
                <div class="col-12">
                    <label class="form-label fw-semibold">Recomendaciones no farmacológicas</label>
                    <textarea name="receta_recomendaciones_no_farmacologicas" class="form-control" rows="2"><?php echo e($receta->recomendaciones_no_farmacologicas); ?></textarea>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Receta
                </button>
                <a href="<?php echo e(route('historial.show', $receta->historial_clinico_id)); ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let medicamentoIndex = <?php echo e(count($medicamentos)); ?>;

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
            const inputs = row.querySelectorAll('input');
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/recetas/edit.blade.php ENDPATH**/ ?>