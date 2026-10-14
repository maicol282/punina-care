<?php $__env->startSection('title', 'Generar Certificado Médico'); ?>
<?php $__env->startSection('page-title', 'Generar Certificado Médico'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="fas fa-certificate me-2 text-primary"></i>
            Generar Certificado Médico
        </h5>
    </div>
    <div class="card-body">

        <!-- ===== INFORMACIÓN DEL PACIENTE ===== -->
        <div class="alert alert-info">
            <div class="row">
                <div class="col-md-3">
                    <strong><i class="fas fa-user me-2"></i>Paciente:</strong>
                    <?php echo e($paciente->nombre); ?> <?php echo e($paciente->apellido); ?>

                </div>
                <div class="col-md-3">
                    <strong><i class="fas fa-id-card me-2"></i>Cédula:</strong>
                    <?php echo e($paciente->cedula ?? 'N/E'); ?>

                </div>
                <div class="col-md-3">
                    <strong><i class="fas fa-calendar me-2"></i>Historial:</strong>
                    <?php echo e($historial->fecha_consulta->format('d/m/Y')); ?>

                </div>
                <div class="col-md-3">
                    <strong><i class="fas fa-phone me-2"></i>Teléfono:</strong>
                    <?php echo e($paciente->telefono ?? 'N/E'); ?>

                </div>
            </div>
        </div>

        <form action="<?php echo e(route('certificados.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="historial_clinico_id" value="<?php echo e($historial->id); ?>">
            <input type="hidden" name="paciente_id" value="<?php echo e($paciente->id); ?>">

            <!-- ===== DATOS DEL PACIENTE ===== -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>Datos del Paciente</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Dirección Domiciliaria</label>
                            <input type="text" name="paciente_direccion" class="form-control" 
                                   value="<?php echo e(old('paciente_direccion', $paciente->direccion ?? '')); ?>" 
                                   placeholder="Calle principal #123">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Teléfono de Contacto</label>
                            <input type="text" name="paciente_telefono" class="form-control" 
                                   value="<?php echo e(old('paciente_telefono', $paciente->telefono ?? '')); ?>" 
                                   placeholder="0987654321">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Institución/Empresa</label>
                            <input type="text" name="paciente_empresa" class="form-control" 
                                   value="<?php echo e(old('paciente_empresa')); ?>" 
                                   placeholder="Nombre de la empresa">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Puesto de Trabajo</label>
                            <input type="text" name="paciente_puesto" class="form-control" 
                                   value="<?php echo e(old('paciente_puesto')); ?>" 
                                   placeholder="Cargo o puesto">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== DATOS DEL CERTIFICADO ===== -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-notes-medical me-2 text-primary"></i>Datos del Certificado</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha de Atención <span class="text-danger">*</span></label>
                            <input type="date" name="fecha_atencion" class="form-control" 
                                   value="<?php echo e(old('fecha_atencion', date('Y-m-d'))); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tipo de Contingencia <span class="text-danger">*</span></label>
                            <select name="tipo_contingencia" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <?php $__currentLoopData = $tiposContingencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(old('tipo_contingencia') == $key ? 'selected' : ''); ?>>
                                        <?php echo e($label); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Diagnósticos <span class="text-danger">*</span></label>
                            <textarea name="diagnosticos" rows="4" 
                                      class="form-control <?php $__errorArgs = ['diagnosticos'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      placeholder="Ej:&#10;FARINGITIS ESTREPTOCOCICA J020&#10;EXTENSION DE CERTIFICADO MEDICO CIE 10 Z027" 
                                      required><?php echo e(old('diagnosticos', $diagnosticosFormateados ?? '')); ?></textarea>
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Incluir el código CIE-10 si está disponible. Cada diagnóstico en una línea diferente.
                            </small>
                            <?php $__errorArgs = ['diagnosticos'];
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
            </div>

            <!-- ===== REPOSO ===== -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-bed me-2 text-warning"></i>Reposo Médico</h6>
                </div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="reposo" name="reposo" value="1" 
                               <?php echo e(old('reposo') ? 'checked' : ''); ?>>
                        <label class="form-check-label fw-bold" for="reposo">
                            <i class="fas fa-bed me-1 text-warning"></i> Indicar Reposo Médico
                        </label>
                    </div>

                    <div id="reposoContainer" style="display: <?php echo e(old('reposo') ? 'block' : 'none'); ?>;">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Fecha Inicio Reposo <span class="text-danger">*</span></label>
                                <input type="date" name="reposo_inicio" id="reposo_inicio" class="form-control" 
                                       value="<?php echo e(old('reposo_inicio', date('Y-m-d'))); ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Fecha Fin Reposo <span class="text-danger">*</span></label>
                                <input type="date" name="reposo_fin" id="reposo_fin" class="form-control" 
                                       value="<?php echo e(old('reposo_fin', date('Y-m-d', strtotime('+3 days')))); ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Días de Reposo</label>
                                <input type="number" name="reposo_dias" id="reposo_dias" class="form-control" 
                                       value="<?php echo e(old('reposo_dias', 3)); ?>" min="1" readonly 
                                       style="background-color: #e9ecef;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== OBSERVACIONES ===== -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-comment me-2 text-primary"></i>Observaciones</h6>
                </div>
                <div class="card-body">
                    <textarea name="observaciones" rows="3" class="form-control" 
                              placeholder="Observaciones adicionales..."><?php echo e(old('observaciones')); ?></textarea>
                </div>
            </div>

            <!-- ===== DATOS DEL MÉDICO ===== -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-user-md me-2 text-primary"></i>Datos del Médico</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-light mb-0">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Nombre:</strong>
                                <span class="text-primary"><?php echo e($medico->name ?? 'Médico Responsable'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <strong>Especialidad:</strong>
                                <span class="text-primary"><?php echo e($medico->especialidad ?? 'Medicina General'); ?></span>
                            </div>
                            <div class="col-md-4">
                                <strong>Cédula:</strong>
                                <span class="text-primary"><?php echo e($medico->cedula ?? 'N/E'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== BOTONES ===== -->
            <div class="d-flex justify-content-end gap-3">
                <a href="<?php echo e(route('historial.show', $historial)); ?>" class="btn btn-secondary">
                    <i class="fas fa-times me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Generar Certificado
                </button>
            </div>

        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== TOGGLE REPOSO =====
    const reposoCheckbox = document.getElementById('reposo');
    const reposoContainer = document.getElementById('reposoContainer');
    const reposoInicio = document.getElementById('reposo_inicio');
    const reposoFin = document.getElementById('reposo_fin');
    const reposoDias = document.getElementById('reposo_dias');

    if (reposoCheckbox) {
        reposoCheckbox.addEventListener('change', function() {
            if (this.checked) {
                reposoContainer.style.display = 'block';
            } else {
                reposoContainer.style.display = 'none';
                if (reposoInicio) reposoInicio.value = '';
                if (reposoFin) reposoFin.value = '';
                if (reposoDias) reposoDias.value = '';
            }
        });
    }

    // ===== CALCULAR DÍAS DE REPOSO =====
    function calcularDias() {
        if (reposoInicio && reposoFin && reposoInicio.value && reposoFin.value) {
            const inicio = new Date(reposoInicio.value);
            const fin = new Date(reposoFin.value);
            if (fin >= inicio) {
                const diffTime = Math.abs(fin - inicio);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                if (reposoDias) reposoDias.value = diffDays;
            }
        }
    }

    if (reposoInicio && reposoFin) {
        reposoInicio.addEventListener('change', calcularDias);
        reposoFin.addEventListener('change', calcularDias);
        reposoInicio.addEventListener('input', calcularDias);
        reposoFin.addEventListener('input', calcularDias);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/certificados/create.blade.php ENDPATH**/ ?>