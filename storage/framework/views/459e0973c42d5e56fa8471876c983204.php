

<?php $__env->startSection('title', 'Recetas Médicas'); ?>
<?php $__env->startSection('page-title', 'Recetario Médico'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-prescription-bottle me-2 text-primary"></i>
            Recetas - <?php echo e($historial->paciente->nombre_completo); ?>

            <small class="text-muted">(Consulta: <?php echo e($historial->fecha_consulta->format('d/m/Y')); ?>)</small>
        </h5>
        <div>
            <a href="<?php echo e(route('recetas.create', $historial)); ?>" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i> Nueva Receta
            </a>
            <?php if($recetas->count() > 0): ?>
            <a href="<?php echo e(route('recetas.imprimir.todas', $historial)); ?>" class="btn btn-secondary btn-sm" target="_blank">
                <i class="fas fa-file-pdf me-1"></i> Imprimir Todas
            </a>
            <?php endif; ?>
            <a href="<?php echo e(route('historial.show', $historial)); ?>" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>
    </div>
    <div class="card-body">
        <?php if($recetas->count() > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Medicamento</th>
                            <th>Dosis</th>
                            <th>Frecuencia</th>
                            <th>Duración</th>
                            <th>Signos Alarma</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $recetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($receta->fecha_emision->format('d/m/Y')); ?></td>
                            <td>
                                <strong><?php echo e($receta->medicamento); ?></strong>
                                <?php if($receta->presentacion): ?><br><small><?php echo e($receta->presentacion); ?></small><?php endif; ?>
                            </td>
                            <td><?php echo e($receta->dosis); ?></td>
                            <td><?php echo e($receta->frecuencia); ?></td>
                            <td><?php echo e($receta->duracion); ?></td>
                            <td>
                                <?php if($receta->signos_alarma): ?>
                                    <span class="badge bg-warning text-dark" title="<?php echo e($receta->signos_alarma); ?>">
                                        <i class="fas fa-exclamation-triangle"></i> <?php echo e(Str::limit($receta->signos_alarma, 30)); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">No registrados</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
    <a href="<?php echo e(route('recetas.edit', $receta->id)); ?>" class="btn btn-sm btn-warning" title="Editar receta" data-bs-toggle="tooltip">
        <i class="fas fa-edit"></i>
    </a>
    <a href="<?php echo e(route('recetas.imprimir', $receta->id)); ?>" class="btn btn-sm btn-secondary" target="_blank" title="Imprimir receta en PDF" data-bs-toggle="tooltip">
        <i class="fas fa-file-pdf"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger"
            onclick="confirmDelete(event, 'delete-form-<?php echo e($receta->id); ?>')"
            title="Eliminar receta" data-bs-toggle="tooltip">
        <i class="fas fa-trash"></i>
    </button>
</div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-4">
                <i class="fas fa-prescription-bottle fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hay recetas registradas</h5>
                <a href="<?php echo e(route('recetas.create', $historial)); ?>" class="btn btn-primary mt-2">
                    <i class="fas fa-plus me-1"></i> Crear Primera Receta
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/recetas/index.blade.php ENDPATH**/ ?>