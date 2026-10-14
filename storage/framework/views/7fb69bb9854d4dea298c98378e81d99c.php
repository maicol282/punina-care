<?php $__env->startSection('title', 'Detalle de Certificado Médico'); ?>
<?php $__env->startSection('page-title', 'Detalle de Certificado Médico'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <!-- Acciones -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="<?php echo e(route('certificados.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
            <div>
                <a href="<?php echo e(route('certificados.imprimir', $certificado)); ?>" class="btn btn-success" target="_blank">
                    <i class="fas fa-file-pdf me-1"></i> Imprimir PDF
                </a>
                <a href="<?php echo e(route('certificados.edit', $certificado)); ?>" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
                <form action="<?php echo e(route('certificados.destroy', $certificado)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este certificado?')">
                        <i class="fas fa-trash me-1"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>

        <!-- Tarjeta Principal -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-certificate me-2"></i>
                    Certificado Médico #<?php echo e($certificado->numero_certificado); ?>

                    <span class="badge bg-<?php echo e($certificado->estado == 'activo' ? 'success' : 'danger'); ?> ms-2">
                        <?php echo e($certificado->estado_label); ?>

                    </span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <!-- Información del Paciente -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-user me-2"></i> Información del Paciente
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <p><strong>Nombre:</strong></p>
                                <p><strong>Cédula:</strong></p>
                                <p><strong>Dirección:</strong></p>
                                <p><strong>Teléfono:</strong></p>
                                <p><strong>Empresa:</strong></p>
                                <p><strong>Puesto:</strong></p>
                            </div>
                            <div class="col-7">
                                <p><?php echo e($certificado->paciente_nombre); ?></p>
                                <p><?php echo e($certificado->paciente_cedula); ?></p>
                                <p><?php echo e($certificado->paciente_direccion ?? 'No especificada'); ?></p>
                                <p><?php echo e($certificado->paciente_telefono ?? 'No especificado'); ?></p>
                                <p><?php echo e($certificado->paciente_empresa ?? 'No especificada'); ?></p>
                                <p><?php echo e($certificado->paciente_puesto ?? 'No especificado'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Certificado -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-info-circle me-2"></i> Información del Certificado
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <p><strong>Número:</strong></p>
                                <p><strong>Fecha Atención:</strong></p>
                                <p><strong>Tipo Contingencia:</strong></p>
                                <p><strong>Reposo:</strong></p>
                                <?php if($certificado->reposo): ?>
                                    <p><strong>Inicio Reposo:</strong></p>
                                    <p><strong>Fin Reposo:</strong></p>
                                    <p><strong>Días Reposo:</strong></p>
                                <?php endif; ?>
                            </div>
                            <div class="col-7">
                                <p><span class="badge bg-dark"><?php echo e($certificado->numero_certificado); ?></span></p>
                                <p><?php echo e($certificado->fecha_atencion->format('d/m/Y')); ?></p>
                                <p><span class="badge bg-info"><?php echo e($certificado->tipo_contingencia_label); ?></span></p>
                                <p>
                                    <?php if($certificado->reposo): ?>
                                        <span class="badge bg-warning">Sí</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No</span>
                                    <?php endif; ?>
                                </p>
                                <?php if($certificado->reposo): ?>
                                    <p><?php echo e($certificado->reposo_inicio->format('d/m/Y')); ?></p>
                                    <p><?php echo e($certificado->reposo_fin->format('d/m/Y')); ?></p>
                                    <p><span class="badge bg-danger"><?php echo e($certificado->reposo_dias); ?> días</span></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Diagnósticos -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-stethoscope me-2"></i> Diagnósticos
                        </h6>
                        <hr>
                        <?php
                            $diagnosticos = explode("\n", trim($certificado->diagnosticos));
                        ?>
                        <?php $__currentLoopData = $diagnosticos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnostico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(trim($diagnostico)): ?>
                                <p class="mb-1"><strong>•</strong> <?php echo e(trim($diagnostico)); ?></p>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Observaciones -->
                    <?php if($certificado->observaciones): ?>
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-comment me-2"></i> Observaciones
                        </h6>
                        <hr>
                        <p><?php echo e($certificado->observaciones); ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Datos del Médico -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-user-md me-2"></i> Datos del Médico
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Nombre:</strong>
                                <p><?php echo e($certificado->medico_nombre); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong>Especialidad:</strong>
                                <p><?php echo e($certificado->medico_especialidad ?? 'Medicina General'); ?></p>
                            </div>
                            <div class="col-md-4">
                                <strong>Cédula:</strong>
                                <p><?php echo e($certificado->medico_cedula ?? 'N/E'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Historial Asociado -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-notes-medical me-2"></i> Historial Asociado
                        </h6>
                        <hr>
                        <a href="<?php echo e(route('historial.show', $certificado->historialClinico)); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> Ver Historial del <?php echo e($certificado->historialClinico->fecha_consulta->format('d/m/Y')); ?>

                        </a>
                        <a href="<?php echo e(route('pacientes.show', $certificado->paciente)); ?>" class="btn btn-outline-info">
                            <i class="fas fa-user me-1"></i> Ver Perfil del Paciente
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>
                    Creado: <?php echo e($certificado->created_at->format('d/m/Y H:i')); ?> | 
                    Última modificación: <?php echo e($certificado->updated_at->format('d/m/Y H:i')); ?>

                </small>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/certificados/show.blade.php ENDPATH**/ ?>