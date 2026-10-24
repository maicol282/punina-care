

<?php $__env->startSection('title', 'Todas las Recetas'); ?>
<?php $__env->startSection('page-title', 'Listado General de Recetas Médicas'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-prescription-bottle me-2 text-primary"></i>Todas las Recetas Médicas</h5>
        
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Medicamento</th>
                        <th>Dosis</th>
                        <th>Fecha Emisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $receta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($receta->id); ?></td>
                        <td>
                            <strong><?php echo e($receta->historialClinico->paciente->nombre_completo); ?></strong>
                            <br>
                            <small class="text-muted"><?php echo e($receta->historialClinico->paciente->cedula ?? 'N/A'); ?></small>
                        </td>
                        <td>
                            <strong><?php echo e($receta->medicamento); ?></strong>
                            <?php if($receta->presentacion): ?>
                                <br><small><?php echo e($receta->presentacion); ?> - <?php echo e($receta->concentracion); ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($receta->dosis); ?> - <?php echo e($receta->frecuencia); ?> - <?php echo e($receta->duracion); ?></td>
                        <td><?php echo e($receta->fecha_emision->format('d/m/Y')); ?></td>
                        <td>
                            <div class="btn-group">
                                <a href="<?php echo e(route('historial.show', $receta->historialClinico)); ?>" 
                                   class="btn btn-sm btn-info" title="Ver historial" data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?php echo e(route('recetas.imprimir', $receta->id)); ?>" 
                                   class="btn btn-sm btn-secondary" target="_blank" title="Imprimir receta" data-bs-toggle="tooltip">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <a href="<?php echo e(route('recetas.edit', $receta->id)); ?>" 
                                   class="btn btn-sm btn-warning" title="Editar receta" data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                </a>
                               <!-- <a href="<?php echo e(route('exportar.recetas')); ?>" class="btn btn-success btn-sm" target="_blank">
                                    <i class="fas fa-file-excel me-1"></i> Exportar Excel
                                </a> -->
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete(event, 'delete-form-<?php echo e($receta->id); ?>')"
                                        title="Eliminar receta" data-bs-toggle="tooltip">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            <form id="delete-form-<?php echo e($receta->id); ?>" 
                                  action="<?php echo e(route('recetas.destroy', $receta->id)); ?>" 
                                  method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-prescription-bottle fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No hay recetas médicas registradas</h5>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            <?php echo e($recetas->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/recetas/todas.blade.php ENDPATH**/ ?>