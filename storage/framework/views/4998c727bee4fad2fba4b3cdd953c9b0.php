<div class="col-md-8">
    <!-- Historial Clínico -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-notes-medical me-2"></i>Historial Clínico</h5>
            <span class="badge bg-primary"><?php echo e($paciente->historialClinicos->count()); ?> registros</span>
        </div>
        <div class="card-body">
            <?php $__empty_1 = true; $__currentLoopData = $paciente->historialClinicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $historial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="card mb-3 border-<?php echo e($loop->first ? 'primary' : 'secondary'); ?>">
                    <div class="card-header bg-<?php echo e($loop->first ? 'primary' : 'light'); ?> text-<?php echo e($loop->first ? 'white' : 'dark'); ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-calendar me-2"></i>
                                <?php echo e($historial->fecha_consulta->format('d/m/Y')); ?>

                                <?php if($loop->first): ?>
                                    <span class="badge bg-warning text-dark ms-2">Última consulta</span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <span class="badge bg-<?php echo e($loop->first ? 'light' : 'secondary'); ?> text-dark me-2">
                                    Dr. <?php echo e($historial->doctor ?? 'No especificado'); ?>

                                </span>
                                <a href="<?php echo e(route('historial.show', $historial)); ?>" 
                                   class="btn btn-sm btn-<?php echo e($loop->first ? 'light' : 'primary'); ?>"
                                   title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Motivo:</strong></p>
                                <p class="text-muted"><?php echo e(Str::limit($historial->motivo_consulta, 100)); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Diagnóstico:</strong></p>
                                <?php if($historial->diagnosticos && $historial->diagnosticos->count() > 0): ?>
                                    <?php $__currentLoopData = $historial->diagnosticos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge bg-primary me-1 mb-1">
                                            <?php echo e(Str::limit($diag->descripcion, 40)); ?>

                                            <?php if($diag->cie10_code): ?>
                                                <span class="badge bg-light text-dark ms-1"><?php echo e($diag->cie10_code); ?></span>
                                            <?php endif; ?>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <p class="text-muted">Sin diagnóstico</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <?php if($historial->seguimientos_count > 0): ?>
                            <div class="mt-2">
                                <span class="badge bg-info">
                                    <i class="fas fa-clock me-1"></i><?php echo e($historial->seguimientos_count); ?> seguimientos
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-3">
                            <a href="<?php echo e(route('historial.show', $historial)); ?>" 
                               class="btn btn-sm btn-outline-primary">
                                Ver detalles completos
                            </a>
                        
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear seguimientos')): ?>
                            <a href="<?php echo e(route('seguimientos.create', $historial)); ?>" 
                               class="btn btn-sm btn-outline-success">
                                <i class="fas fa-plus-circle me-1"></i> Agregar Seguimiento
                            </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('reportes.historial', $historial)); ?>" 
                               class="btn btn-sm btn-outline-secondary" target="_blank">
                                <i class="fas fa-file-pdf me-1"></i> PDF
                            </a>
                            <a href="<?php echo e(route('recetas.index', $historial->id)); ?>" class="btn btn-success px-4 py-2">
                                <i class="fas fa-prescription me-2"></i> Recetas
                            </a>
                            <a href="<?php echo e(route('pedidos-examenes.create', ['paciente_id' => $paciente->id, 'historial_id' => $historial->id])); ?>" class="btn btn-sm btn-info text-white">
                            <i class="fas fa-flask me-1"></i> Exámenes
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="text-center py-4">
                    <i class="fas fa-notes-medical fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No hay historial clínico registrado</h5>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear historiales')): ?>
                    <a href="<?php echo e(route('historial.create', $paciente)); ?>" class="btn btn-primary mt-2">
                        <i class="fas fa-plus-circle me-1"></i> Crear Primer Historial
                    </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tarjeta de Facturación -->
    <?php if($paciente->ruc || $paciente->razon_social): ?>
    <div class="card mt-3">
        <div class="card-header bg-white">
            <h6 class="mb-0"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Datos de Facturación (SRI)</h6>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <?php if($paciente->ruc): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-id-card me-2 text-muted"></i>RUC:</span>
                    <span><?php echo e($paciente->ruc); ?></span>
                </li>
                <?php endif; ?>
                <?php if($paciente->razon_social): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-building me-2 text-muted"></i>Razón Social:</span>
                    <span><?php echo e($paciente->razon_social); ?></span>
                </li>
                <?php endif; ?>
                <?php if($paciente->direccion_fiscal): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-map-marker-alt me-2 text-muted"></i>Dirección Fiscal:</span>
                    <span><?php echo e($paciente->direccion_fiscal); ?></span>
                </li>
                <?php endif; ?>
                <?php if($paciente->telefono_facturacion): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-phone me-2 text-muted"></i>Teléfono Facturación:</span>
                    <span><?php echo e($paciente->telefono_facturacion); ?></span>
                </li>
                <?php endif; ?>
                <?php if($paciente->email_facturacion): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-envelope me-2 text-muted"></i>Email Facturación:</span>
                    <span><?php echo e($paciente->email_facturacion); ?></span>
                </li>
                <?php endif; ?>
                <?php if($paciente->obligado_contabilidad): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-calculator me-2 text-muted"></i>Obligado a llevar contabilidad:</span>
                    <span class="badge bg-info">Sí</span>
                </li>
                <?php endif; ?>
                <?php if($paciente->contribuyente_especial): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-star me-2 text-muted"></i>Contribuyente Especial:</span>
                    <span class="badge bg-warning">Sí</span>
                </li>
                <?php endif; ?>
                <?php if($paciente->agente_retencion): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-hand-holding-usd me-2 text-muted"></i>Agente de Retención:</span>
                    <span class="badge bg-danger">Sí</span>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/partials/show/_historiales.blade.php ENDPATH**/ ?>