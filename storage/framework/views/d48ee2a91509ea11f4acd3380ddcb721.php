<div class="col-md-4 mb-4">
    <!-- Tarjeta de Perfil del Paciente -->
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
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/partials/show/_sidebar.blade.php ENDPATH**/ ?>