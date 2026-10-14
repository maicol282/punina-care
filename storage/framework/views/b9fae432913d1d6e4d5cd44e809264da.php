

<?php $__env->startSection('title', 'Editar Seguimiento'); ?>
<?php $__env->startSection('page-title', 'Editar Seguimiento'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <!-- Información de la Consulta -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-notes-medical me-2"></i>
                    Editando Seguimiento - <?php echo e($seguimiento->fecha_seguimiento->format('d/m/Y')); ?>

                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Paciente:</strong> <?php echo e($seguimiento->historialClinico->paciente->nombre_completo); ?></p>
                        <p><strong>Fecha consulta original:</strong> <?php echo e($seguimiento->historialClinico->fecha_consulta->format('d/m/Y')); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Motivo:</strong> <?php echo e(Str::limit($seguimiento->historialClinico->motivo_consulta, 50)); ?></p>
                        <p><strong>Diagnóstico:</strong> <?php echo e(Str::limit($seguimiento->historialClinico->diagnostico, 50)); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- INICIO DEL FORMULARIO DE EDICIÓN -->
        <form action="<?php echo e(route('seguimientos.update', $seguimiento)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2 text-primary"></i>Editar Datos del Seguimiento</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha_seguimiento" class="form-label">Fecha de Seguimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control <?php $__errorArgs = ['fecha_seguimiento'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="fecha_seguimiento" name="fecha_seguimiento" 
                                   value="<?php echo e(old('fecha_seguimiento', $seguimiento->fecha_seguimiento->format('Y-m-d'))); ?>" required>
                            <?php $__errorArgs = ['fecha_seguimiento'];
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
                            <label for="proxima_cita" class="form-label">Próxima Cita</label>
                            <input type="date" class="form-control <?php $__errorArgs = ['proxima_cita'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="proxima_cita" name="proxima_cita" 
                                   value="<?php echo e(old('proxima_cita', $seguimiento->proxima_cita?->format('Y-m-d'))); ?>">
                            <?php $__errorArgs = ['proxima_cita'];
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
                    </div>

                    <div class="mb-3">
                        <label for="evolucion" class="form-label">Evolución del Paciente <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['evolucion'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="evolucion" name="evolucion" rows="4" required><?php echo e(old('evolucion', $seguimiento->evolucion)); ?></textarea>
                        <?php $__errorArgs = ['evolucion'];
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
                        <label for="nuevos_sintomas" class="form-label">Nuevos Síntomas</label>
                        <textarea class="form-control <?php $__errorArgs = ['nuevos_sintomas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="nuevos_sintomas" name="nuevos_sintomas" rows="2"><?php echo e(old('nuevos_sintomas', $seguimiento->nuevos_sintomas)); ?></textarea>
                        <?php $__errorArgs = ['nuevos_sintomas'];
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
                        <label for="medicamentos_ajustados" class="form-label">Ajuste de Medicamentos</label>
                        <textarea class="form-control <?php $__errorArgs = ['medicamentos_ajustados'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="medicamentos_ajustados" name="medicamentos_ajustados" rows="2"><?php echo e(old('medicamentos_ajustados', $seguimiento->medicamentos_ajustados)); ?></textarea>
                        <?php $__errorArgs = ['medicamentos_ajustados'];
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
                        <label for="recomendaciones" class="form-label">Recomendaciones <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['recomendaciones'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="recomendaciones" name="recomendaciones" rows="3" required><?php echo e(old('recomendaciones', $seguimiento->recomendaciones)); ?></textarea>
                        <?php $__errorArgs = ['recomendaciones'];
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
                </div>
            </div>

            <!-- BOTONES -->
            <div class="row mt-4">
                <div class="col-12 text-end">
                    <a href="<?php echo e(route('historial.show', $seguimiento->historialClinico)); ?>" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Actualizar Seguimiento
                    </button>
                </div>
            </div>

        </form>
        <!-- FIN DEL FORMULARIO -->

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/seguimientos/edit.blade.php ENDPATH**/ ?>