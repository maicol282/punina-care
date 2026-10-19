

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
                            <div class="btn-group">
                                <a href="<?php echo e(route('usuarios.edit', $usuario)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php if($usuario->id !== auth()->id()): ?>
                                <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete(event, 'delete-form-<?php echo e($usuario->id); ?>')">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <?php endif; ?>
                            </div>
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