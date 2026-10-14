<?php $__env->startSection('title', 'Detalle de Reposo'); ?>
<?php $__env->startSection('page-title', 'Detalle del Reposo Médico'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <!-- Acciones -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="<?php echo e(route('reposos.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
            <div>
                <a href="<?php echo e(route('reposos.imprimir', $reposo)); ?>" class="btn btn-success" target="_blank">
                    <i class="fas fa-file-pdf me-1"></i> Imprimir PDF
                </a>
                <a href="<?php echo e(route('reposos.edit', $reposo)); ?>" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Editar
                </a>
                <form action="<?php echo e(route('reposos.destroy', $reposo)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este reposo?')">
                        <i class="fas fa-trash me-1"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>

        <!-- Tarjeta Principal -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-bed me-2"></i>
                    Reposo Médico #<?php echo e($reposo->numero_reposo); ?>

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
                                <p><strong>Teléfono:</strong></p>
                                <p><strong>Email:</strong></p>
                            </div>
                            <div class="col-7">
                                <p><?php echo e($reposo->paciente->nombre); ?> <?php echo e($reposo->paciente->apellido); ?></p>
                                <p><?php echo e($reposo->paciente->cedula ?? 'N/E'); ?></p>
                                <p><?php echo e($reposo->paciente->telefono ?? 'N/E'); ?></p>
                                <p><?php echo e($reposo->paciente->email ?? 'N/E'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Información del Reposo -->
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-info-circle me-2"></i> Información del Reposo
                        </h6>
                        <hr>
                        <div class="row">
                            <div class="col-5">
                                <p><strong>Número:</strong></p>
                                <p><strong>Fecha Inicio:</strong></p>
                                <p><strong>Fecha Fin:</strong></p>
                                <p><strong>Días:</strong></p>
                                <p><strong>Tipo:</strong></p>
                                <p><strong>Estado:</strong></p>
                                <p><strong>Médico Emisor:</strong></p>
                            </div>
                            <div class="col-7">
                                <p><span class="badge bg-dark"><?php echo e($reposo->numero_reposo); ?></span></p>
                                <p><?php echo e($reposo->fecha_inicio->format('d/m/Y')); ?></p>
                                <p><?php echo e($reposo->fecha_fin->format('d/m/Y')); ?></p>
                                <p><span class="badge bg-info"><?php echo e($reposo->dias); ?> días</span></p>
                                <p><span class="badge bg-secondary"><?php echo e($reposo->tipo_label); ?></span></p>
                                <p><span class="badge bg-<?php echo e($reposo->estado_color); ?>"><?php echo e($reposo->estado_label); ?></span></p>
                                <p><?php echo e($reposo->medico_emisor); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Diagnóstico -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-stethoscope me-2"></i> Diagnóstico
                        </h6>
                        <hr>
                        <p class="mb-0" style="white-space: pre-wrap;"><?php echo e($reposo->diagnostico); ?></p>
                    </div>

                    <!-- Recomendaciones -->
                    <?php if($reposo->recomendaciones): ?>
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-clipboard-list me-2"></i> Recomendaciones
                        </h6>
                        <hr>
                        <p class="mb-0" style="white-space: pre-wrap;"><?php echo e($reposo->recomendaciones); ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Historial Asociado -->
                    <div class="col-12">
                        <h6 class="fw-bold text-primary">
                            <i class="fas fa-notes-medical me-2"></i> Historial Asociado
                        </h6>
                        <hr>
                        <a href="<?php echo e(route('historial.show', $reposo->historialClinico)); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> Ver Historial del <?php echo e($reposo->historialClinico->fecha_consulta->format('d/m/Y')); ?>

                        </a>
                        <a href="<?php echo e(route('pacientes.show', $reposo->paciente)); ?>" class="btn btn-outline-info">
                            <i class="fas fa-user me-1"></i> Ver Perfil del Paciente
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                <small>
                    Creado: <?php echo e($reposo->created_at->format('d/m/Y H:i')); ?> | 
                    Última modificación: <?php echo e($reposo->updated_at->format('d/m/Y H:i')); ?>

                </small>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/reposos/show.blade.php ENDPATH**/ ?>