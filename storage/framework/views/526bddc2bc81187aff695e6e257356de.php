<?php $__env->startSection('title', 'Punina Care - Editar Consulta'); ?>
<?php $__env->startSection('page-title', 'Editar Consulta de Telemedicina'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-video me-2 text-primary"></i>
            Editar Consulta #<?php echo e($consulta->id); ?>

        </h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('telemedicina.update', $consulta)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Paciente <span class="text-danger">*</span></label>
                    <select name="paciente_id" class="form-select" required>
                        <option value="">Seleccione un paciente...</option>
                        <?php $__currentLoopData = $pacientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paciente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($paciente->id); ?>" <?php echo e(old('paciente_id', $consulta->paciente_id) == $paciente->id ? 'selected' : ''); ?>>
                                <?php echo e($paciente->nombre); ?> <?php echo e($paciente->apellido); ?> - <?php echo e($paciente->cedula ?? 'N/E'); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Médico <span class="text-danger">*</span></label>
                    <select name="medico_id" class="form-select" required>
                        <option value="">Seleccione un médico...</option>
                        <?php $__currentLoopData = $medicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($medico->id); ?>" <?php echo e(old('medico_id', $consulta->medico_id) == $medico->id ? 'selected' : ''); ?>>
                                <?php echo e($medico->name); ?> - <?php echo e($medico->especialidad ?? 'Médico General'); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha y Hora <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="fecha_hora_programada" class="form-control" 
                           value="<?php echo e(old('fecha_hora_programada', $consulta->fecha_hora_programada->format('Y-m-d\TH:i'))); ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Duración (minutos) <span class="text-danger">*</span></label>
                    <input type="number" name="duracion" class="form-control" 
                           value="<?php echo e(old('duracion', $consulta->duracion)); ?>" min="15" max="120" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Estado <span class="text-danger">*</span></label>
                    <select name="estado" class="form-select" required>
                        <option value="programada" <?php echo e(old('estado', $consulta->estado) == 'programada' ? 'selected' : ''); ?>>Programada</option>
                        <option value="en_curso" <?php echo e(old('estado', $consulta->estado) == 'en_curso' ? 'selected' : ''); ?>>En curso</option>
                        <option value="completada" <?php echo e(old('estado', $consulta->estado) == 'completada' ? 'selected' : ''); ?>>Completada</option>
                        <option value="cancelada" <?php echo e(old('estado', $consulta->estado) == 'cancelada' ? 'selected' : ''); ?>>Cancelada</option>
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Motivo de la consulta <span class="text-danger">*</span></label>
                    <textarea name="motivo" rows="3" class="form-control" required><?php echo e(old('motivo', $consulta->motivo)); ?></textarea>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Notas adicionales</label>
                    <textarea name="notas" rows="2" class="form-control"><?php echo e(old('notas', $consulta->notas)); ?></textarea>
                </div>

                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Enlace de videollamada:</strong>
                        <a href="<?php echo e($consulta->enlace_acceso); ?>" target="_blank" class="text-primary">
                            <?php echo e($consulta->enlace_acceso); ?>

                        </a>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-3">
                <a href="<?php echo e(route('telemedicina.show', $consulta)); ?>" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Actualizar Consulta
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/telemedicina/edit.blade.php ENDPATH**/ ?>