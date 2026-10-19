

<?php $__env->startSection('title', 'Editar Usuario'); ?>
<?php $__env->startSection('page-title', 'Editar Usuario'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Usuario: <?php echo e($usuario->name); ?></h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('usuarios.update', $usuario)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="name" name="name" value="<?php echo e(old('name', $usuario->name)); ?>" required>
                    <?php $__errorArgs = ['name'];
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

                <div class="col-md-6 mb-3">
                    <label for="cedula" class="form-label">Cédula <span class="text-danger">*</span></label>
                    <input type="text" class="form-control <?php $__errorArgs = ['cedula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="cedula" name="cedula" value="<?php echo e(old('cedula', $usuario->cedula)); ?>" required placeholder="Ej: 1712345678">
                    <?php $__errorArgs = ['cedula'];
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

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="email" name="email" value="<?php echo e(old('email', $usuario->email)); ?>" required>
                    <?php $__errorArgs = ['email'];
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

                <div class="col-md-6 mb-3">
                    <label for="role" class="form-label">Rol <span class="text-danger">*</span></label>
                    <select class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            id="role" name="role" required>
                        <option value="">Seleccione un rol...</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rol): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rol->name); ?>" 
                                <?php echo e($usuario->hasRole($rol->name) ? 'selected' : ''); ?>>
                                <?php echo e($rol->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['role'];
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
                <div class="col-md-6 mb-3">
    <label for="especialidad" class="form-label">Especialidad</label>
    <select class="form-select <?php $__errorArgs = ['especialidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="especialidad" name="especialidad">
        <option value="">Seleccione una especialidad...</option>
        <option value="Medicina General" <?php echo e(old('especialidad', $usuario->especialidad) == 'Medicina General' ? 'selected' : ''); ?>>Medicina General</option>
        <option value="Cardiología" <?php echo e(old('especialidad', $usuario->especialidad) == 'Cardiología' ? 'selected' : ''); ?>>Cardiología</option>
        <option value="Pediatría" <?php echo e(old('especialidad', $usuario->especialidad) == 'Pediatría' ? 'selected' : ''); ?>>Pediatría</option>
        <option value="Ginecología" <?php echo e(old('especialidad', $usuario->especialidad) == 'Ginecología' ? 'selected' : ''); ?>>Ginecología</option>
        <option value="Traumatología" <?php echo e(old('especialidad', $usuario->especialidad) == 'Traumatología' ? 'selected' : ''); ?>>Traumatología</option>
        <option value="Dermatología" <?php echo e(old('especialidad', $usuario->especialidad) == 'Dermatología' ? 'selected' : ''); ?>>Dermatología</option>
        <option value="Neurología" <?php echo e(old('especialidad', $usuario->especialidad) == 'Neurología' ? 'selected' : ''); ?>>Neurología</option>
        <option value="Psiquiatría" <?php echo e(old('especialidad', $usuario->especialidad) == 'Psiquiatría' ? 'selected' : ''); ?>>Psiquiatría</option>
        <option value="Oftalmología" <?php echo e(old('especialidad', $usuario->especialidad) == 'Oftalmología' ? 'selected' : ''); ?>>Oftalmología</option>
        <option value="Odontología" <?php echo e(old('especialidad', $usuario->especialidad) == 'Odontología' ? 'selected' : ''); ?>>Odontología</option>
    </select>
    <?php $__errorArgs = ['especialidad'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
            </div>

            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle me-2"></i>
                Si deseas cambiar la contraseña, usa el registro de nuevo usuario o la opción de recuperación.
            </div>

            <div class="text-end">
                <a href="<?php echo e(route('usuarios.index')); ?>" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/usuarios/edit.blade.php ENDPATH**/ ?>