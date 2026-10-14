<?php $__env->startSection('title', 'Editar Certificado Médico'); ?>
<?php $__env->startSection('page-title', 'Editar Certificado Médico'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Editar Certificado #<?php echo e($certificado->numero_certificado); ?></h5>
    </div>
    <div class="card-body">
        
        <!-- Información del paciente -->
        <div class="alert alert-info">
            <div class="row">
                <div class="col-md-3">
                    <strong>Paciente:</strong> <?php echo e($certificado->paciente->nombre); ?> <?php echo e($certificado->paciente->apellido); ?>

                </div>
                <div class="col-md-3">
                    <strong>Cédula:</strong> <?php echo e($certificado->paciente->cedula ?? 'N/E'); ?>

                </div>
                <div class="col-md-3">
                    <strong>Historial:</strong> <?php echo e($certificado->historialClinico->fecha_consulta->format('d/m/Y')); ?>

                </div>
                <div class="col-md-3">
                    <strong>Teléfono:</strong> <?php echo e($certificado->paciente->telefono ?? 'N/E'); ?>

                </div>
            </div>
        </div>
        
       <form action="<?php echo e(route('certificados.update', $certificado)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="hidden" name="historial_clinico_id" value="<?php echo e($certificado->historial_clinico_id); ?>">
            <input type="hidden" name="paciente_id" value="<?php echo e($certificado->paciente_id); ?>">

            <!-- ===== DATOS DEL PACIENTE ===== -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Dirección Domiciliaria</label>
                    <input type="text" name="paciente_direccion" class="form-control" 
                           value="<?php echo e(old('paciente_direccion', $certificado->paciente_direccion)); ?>" 
                           placeholder="Calle principal #123">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono de Contacto</label>
                    <input type="text" name="paciente_telefono" class="form-control" 
                           value="<?php echo e(old('paciente_telefono', $certificado->paciente_telefono)); ?>" 
                           placeholder="0987654321">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Institución/Empresa</label>
                    <input type="text" name="paciente_empresa" class="form-control" 
                           value="<?php echo e(old('paciente_empresa', $certificado->paciente_empresa)); ?>" 
                           placeholder="Nombre de la empresa">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Puesto de Trabajo</label>
                    <input type="text" name="paciente_puesto" class="form-control" 
                           value="<?php echo e(old('paciente_puesto', $certificado->paciente_puesto)); ?>" 
                           placeholder="Cargo o puesto">
                </div>
            </div>

            <!-- ===== DATOS DEL CERTIFICADO ===== -->
            <div class="row mt-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha de Atención <span class="text-danger">*</span></label>
                    <input type="date" name="fecha_atencion" class="form-control" 
                           value="<?php echo e(old('fecha_atencion', $certificado->fecha_atencion->format('Y-m-d'))); ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Contingencia <span class="text-danger">*</span></label>
                    <select name="tipo_contingencia" class="form-select" required>
                        <option value="">Seleccione...</option>
                        <?php
                            $tiposContingencia = [
                                'enfermedad_general' => 'Enfermedad General',
                                'maternidad' => 'Maternidad',
                                'enfermedad_catastrofica' => 'Enfermedad Catastrófica',
                                'accidente_laboral' => 'Presunción de Accidente Laboral',
                                'enfermedad_laboral' => 'Presunción de Enfermedad Laboral u Ocupacional'
                            ];
                        ?>
                        <?php $__currentLoopData = $tiposContingencia; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e(old('tipo_contingencia', $certificado->tipo_contingencia) == $key ? 'selected' : ''); ?>>
                                <?php echo e($label); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Diagnósticos <span class="text-danger">*</span></label>
                    <textarea name="diagnosticos" rows="4" class="form-control" 
                              placeholder="Ej:&#10;FARINGITIS ESTREPTOCOCICA J020&#10;EXTENSION DE CERTIFICADO MEDICO CIE 10 Z027" 
                              required><?php echo e(old('diagnosticos', $certificado->diagnosticos)); ?></textarea>
                    <small class="text-muted">Cada diagnóstico en una línea diferente.</small>
                </div>
            </div>

            <!-- ===== REPOSO ===== -->
            <div class="mt-3">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="reposo" name="reposo" value="1" 
                           <?php echo e(old('reposo', $certificado->reposo) ? 'checked' : ''); ?>>
                    <label class="form-check-label fw-bold" for="reposo">
                        <i class="fas fa-bed me-1 text-warning"></i> Indicar Reposo Médico
                    </label>
                </div>

                <div id="reposoContainer" style="display: <?php echo e(old('reposo', $certificado->reposo) ? 'block' : 'none'); ?>; margin-top: 10px;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fecha Inicio Reposo</label>
                            <input type="date" name="reposo_inicio" id="reposo_inicio" class="form-control" 
                                   value="<?php echo e(old('reposo_inicio', $certificado->reposo_inicio ? $certificado->reposo_inicio->format('Y-m-d') : '')); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Fecha Fin Reposo</label>
                            <input type="date" name="reposo_fin" id="reposo_fin" class="form-control" 
                                   value="<?php echo e(old('reposo_fin', $certificado->reposo_fin ? $certificado->reposo_fin->format('Y-m-d') : '')); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Días de Reposo</label>
                            <input type="number" name="reposo_dias" id="reposo_dias" class="form-control" 
                                   value="<?php echo e(old('reposo_dias', $certificado->reposo_dias)); ?>" min="1" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== OBSERVACIONES ===== -->
<div class="mt-3">
    <label class="form-label">Observaciones</label>
    <textarea name="observaciones" rows="3" class="form-control" 
              placeholder="Observaciones adicionales..."><?php echo e(old('observaciones', $certificado->observaciones)); ?></textarea>
</div>

<!-- ===== ESTADO ===== -->
<div class="mt-3">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Estado <span class="text-danger">*</span></label>
            <select name="estado" class="form-select" required>
                <option value="activo" <?php echo e(old('estado', $certificado->estado) == 'activo' ? 'selected' : ''); ?>>Activo</option>
                <option value="anulado" <?php echo e(old('estado', $certificado->estado) == 'anulado' ? 'selected' : ''); ?>>Anulado</option>
            </select>
        </div>
    </div>
</div>

<!-- ===== DATOS DEL MÉDICO ===== -->
<div class="mt-3">
    <div class="alert alert-light">
        <div class="row">
            <div class="col-md-4">
                <strong>Médico:</strong> <?php echo e($certificado->medico_nombre); ?>

            </div>
            <div class="col-md-4">
                <strong>Especialidad:</strong> <?php echo e($certificado->medico_especialidad ?? 'Medicina General'); ?>

            </div>
            <div class="col-md-4">
                <strong>Cédula:</strong> <?php echo e($certificado->medico_cedula ?? 'N/E'); ?>

            </div>
        </div>
    </div>
</div>

<!-- ===== BOTONES ===== -->
<div class="d-flex justify-content-end gap-3 mt-4">
    <a href="<?php echo e(route('certificados.show', $certificado)); ?>" class="btn btn-secondary">
        <i class="fas fa-times me-1"></i> Cancelar
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> Actualizar Certificado
    </button>
</div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const reposoCheckbox = document.getElementById('reposo');
    const reposoContainer = document.getElementById('reposoContainer');
    const reposoInicio = document.getElementById('reposo_inicio');
    const reposoFin = document.getElementById('reposo_fin');
    const reposoDias = document.getElementById('reposo_dias');

    if (reposoCheckbox) {
        reposoCheckbox.addEventListener('change', function() {
            reposoContainer.style.display = this.checked ? 'block' : 'none';
            if (!this.checked) {
                reposoInicio.value = '';
                reposoFin.value = '';
                reposoDias.value = '';
            }
        });
    }

    function calcularDias() {
        if (reposoInicio.value && reposoFin.value) {
            const inicio = new Date(reposoInicio.value);
            const fin = new Date(reposoFin.value);
            if (fin >= inicio) {
                const diffDays = Math.ceil((fin - inicio) / (1000 * 60 * 60 * 24)) + 1;
                reposoDias.value = diffDays;
            }
        }
    }

    reposoInicio.addEventListener('change', calcularDias);
    reposoFin.addEventListener('change', calcularDias);
    reposoInicio.addEventListener('input', calcularDias);
    reposoFin.addEventListener('input', calcularDias);
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/certificados/edit.blade.php ENDPATH**/ ?>