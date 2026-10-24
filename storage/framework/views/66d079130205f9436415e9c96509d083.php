<div class="card mb-3">
    <div class="card-header bg-white">
        <h6 class="mb-0"><i class="fas fa-notes-medical me-2 text-primary"></i>Información Médica</h6>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="alergias" class="form-label">
                <i class="fas fa-allergies me-1 text-danger"></i> Alergias
            </label>
            <textarea class="form-control <?php $__errorArgs = ['alergias'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                      id="alergias" name="alergias" rows="3" 
                      placeholder="Ej: Penicilina, Ibuprofeno, látex, polen, etc..."><?php echo e(old('alergias')); ?></textarea>
            <?php $__errorArgs = ['alergias'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                      id="observaciones" name="observaciones" rows="3" 
                      placeholder="Información adicional relevante..."><?php echo e(old('observaciones')); ?></textarea>
            <?php $__errorArgs = ['observaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/partials/create/_informacion-medica.blade.php ENDPATH**/ ?>