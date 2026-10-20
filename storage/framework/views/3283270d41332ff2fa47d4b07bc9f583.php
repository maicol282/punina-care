<?php $__env->startSection('title', 'Médicos'); ?>
<?php $__env->startSection('page-title', 'Gestión de Médicos'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Lista de Médicos</h5>
        <a href="<?php echo e(route('usuarios.create')); ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Nuevo Médico
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
    <tr>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">ID</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Nombre</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Email</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Rol</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Registro</th>
        <th style="background-color: #2c3e50; color: white; font-weight: 500;">Acciones</th>
    </tr>
</thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($usuario->id); ?></td>
                        <td><?php echo e($usuario->name); ?></td>
                        <td><?php echo e($usuario->email); ?></td>
                        <td>
                            <?php $__currentLoopData = $usuario->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-primary"><?php echo e($rol); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td><?php echo e($usuario->created_at->diffForHumans()); ?></td>
                                                   <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('usuarios.edit', $usuario)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón para cambiar contraseña -->
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalReset<?php echo e($usuario->id); ?>" title="Cambiar contraseña">
                                    <i class="fas fa-key"></i>
                                </button>

                                <?php if($usuario->id !== auth()->id()): ?>
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete(event, 'delete-form-<?php echo e($usuario->id); ?>')" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <?php endif; ?>
                            </div>

                            <!-- Formulario oculto para eliminar -->
                            <form id="delete-form-<?php echo e($usuario->id); ?>" 
                                  action="<?php echo e(route('usuarios.destroy', $usuario)); ?>" 
                                  method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                                               
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">No hay médicos registrados</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php echo e($usuarios->links()); ?>

    </div>
</div>
<!-- MODALES DE RESETEO DE CONTRASEÑA (Fuera de la tabla para que funcionen bien) -->
<?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="modalReset<?php echo e($usuario->id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo e(route('usuarios.reset-password', $usuario)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-key me-2"></i>Cambiar contraseña: <?php echo e($usuario->name); ?>

                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nueva Contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required minlength="8">
                        <small class="text-muted">Mínimo 8 caracteres.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required minlength="8">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-info text-white">
                        <i class="fas fa-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        
        if (confirm('¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.')) {
            document.getElementById(formId).submit();
        }
    }
    
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/usuarios/index.blade.php ENDPATH**/ ?>