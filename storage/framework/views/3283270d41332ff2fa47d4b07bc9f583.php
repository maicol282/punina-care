<?php $__env->startSection('title', 'Gestión de Médicos'); ?>
<?php $__env->startSection('page-title', 'Gestión de Médicos'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-user-md me-2 text-primary"></i>Lista de Médicos</h5>
        <a href="<?php echo e(route('usuarios.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Nuevo Médico
        </a>
    </div>
    <div class="card-body">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Cédula</th>
                        <th>Registro</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($usuario->id); ?></td>
                        <td>
                            <strong><?php echo e($usuario->name); ?></strong>
                            <?php if($usuario->especialidad): ?>
                                <br><small class="text-muted"><?php echo e($usuario->especialidad); ?></small>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($usuario->email); ?></td>
                        <td><?php echo e($usuario->cedula); ?></td>
                        <td><?php echo e($usuario->created_at->diffForHumans()); ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="<?php echo e(route('usuarios.edit', $usuario)); ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón para cambiar contraseña -->
                                <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modalReset<?php echo e($usuario->id); ?>" title="Cambiar contraseña">
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
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No hay usuarios registrados.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-3">
            <?php echo e($usuarios->links()); ?>

        </div>
    </div>
</div>

<!-- MODALES DE RESETEO DE CONTRASEÑA (Fuera de la tabla) -->
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
                        <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                        <small class="text-muted">Mínimo 8 caracteres, incluir mayúscula, minúscula, número y símbolo.</small>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/usuarios/index.blade.php ENDPATH**/ ?>