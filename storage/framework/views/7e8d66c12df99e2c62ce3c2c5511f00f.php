

<?php $__env->startSection('title', 'Detalles del Paciente'); ?>
<?php $__env->startSection('page-title', 'Perfil del Paciente'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- Información del Paciente -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                     style="width: 100px; height: 100px; font-size: 40px;">
                    <?php echo e(substr($paciente->nombre, 0, 1)); ?><?php echo e(substr($paciente->apellido, 0, 1)); ?>

                </div>
                <h4><?php echo e($paciente->nombre_completo); ?></h4>
                <p class="text-muted">
                    <i class="fas fa-envelope me-1"></i> <?php echo e($paciente->email); ?><br>
                    <i class="fas fa-phone me-1"></i> <?php echo e($paciente->telefono); ?>

                </p>
                
                <div class="d-grid gap-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar pacientes')): ?>
                    <a href="<?php echo e(route('pacientes.edit', $paciente)); ?>" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i> Editar Perfil
                    </a>
                    <?php endif; ?>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear historiales')): ?>
                    <a href="<?php echo e(route('historial.create', $paciente)); ?>" class="btn btn-success">
                        <i class="fas fa-plus-circle me-1"></i> Nuevo Historial
                    </a>
                    <?php endif; ?>
                    
                    <!-- PDF - Historial Clínico Completo -->
                   
                    
                    <?php if(auth()->user()->hasAnyRole(['Administrador', 'Médico'])): ?>
                    <button type="button" class="btn btn-danger" 
                            onclick="confirmDelete(event, 'delete-paciente-form')">
                        <i class="fas fa-trash me-1"></i> Eliminar Paciente
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Información Adicional -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Adicional</h6>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-birthday-cake me-2 text-muted"></i>Edad:</span>
                        <span class="badge bg-info"><?php echo e($paciente->edad); ?> años</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-venus-mars me-2 text-muted"></i>Género:</span>
                        <span>
                            <?php if($paciente->genero == 'M'): ?>
                                <i class="fas fa-mars text-primary"></i> Masculino
                            <?php elseif($paciente->genero == 'F'): ?>
                                <i class="fas fa-venus text-danger"></i> Femenino
                            <?php else: ?>
                                <i class="fas fa-genderless"></i> <?php echo e($paciente->genero); ?>

                            <?php endif; ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-id-card me-2 text-muted"></i>Cédula:</span>
                        <span class="badge bg-secondary"><?php echo e($paciente->cedula ?? 'No registrada'); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-briefcase me-2 text-muted"></i>Ocupación:</span>
                        <span class="badge bg-info"><?php echo e($paciente->ocupacion ?? 'No registrada'); ?></span>
                    </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-map-marker-alt me-2 text-muted"></i>País:</span>
                        <span><?php echo e($paciente->pais ?? 'No especificado'); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-map-marker-alt me-2 text-muted"></i>Provincia:</span>
                        <span><?php echo e($paciente->provincia ?? 'No especificado'); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-map-marker-alt me-2 text-muted"></i>Ciudad:</span>
                        <span><?php echo e($paciente->ciudad ?? 'No especificado'); ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span><i class="fas fa-home me-2 text-muted"></i>Dirección:</span>
                        <span><?php echo e($paciente->direccion ?? 'No especificada'); ?></span>
                    </li>
                    <?php if($paciente->alergias): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-allergies me-2 text-danger"></i>Alergias:</span>
                    <span class="text-danger"><?php echo e($paciente->alergias); ?></span>
                </li>
                <?php endif; ?>
                </ul>
                
                <?php if($paciente->observaciones): ?>
                <div class="mt-3 p-2 bg-info bg-opacity-10 rounded">
                    <strong class="text-info"><i class="fas fa-comment me-1"></i>Observaciones:</strong>
                    <p class="mb-0 mt-1"><?php echo e($paciente->observaciones); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Historial Clínico -->
    <div class="col-md-8">
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
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/show.blade.php ENDPATH**/ ?>