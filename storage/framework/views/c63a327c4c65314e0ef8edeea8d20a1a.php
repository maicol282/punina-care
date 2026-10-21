    <div class="card border-0 shadow-sm rounded-4 mb-5" style="background-color: var(--gray-bg);">
        <div class="card-body p-4 text-center d-flex flex-wrap justify-content-center gap-2">
            <a href="<?php echo e(route('pacientes.show', $historial->paciente->id)); ?>" class="btn btn-light border px-4 rounded-pill shadow-sm text-dark fw-medium">
                <i class="fas fa-arrow-left me-2"></i> Volver al Paciente
            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar historiales')): ?>
            <a href="<?php echo e(route('historial.edit', $historial->id)); ?>" class="btn btn-warning px-4 rounded-pill shadow-sm text-dark fw-medium">
                <i class="fas fa-edit me-1"></i> Editar Historial
            </a>
            <?php endif; ?>
            
            <!-- Recetas / Certificados / Reposos -->
            <div class="btn-group shadow-sm ms-md-auto">
                <?php if($historial->recetas->count() > 0): ?>
                    <a href="<?php echo e(route('recetas.index', $historial)); ?>" class="btn" style="background-color: #6366f1; color: white;">
                        <i class="fas fa-prescription-bottle-alt me-1"></i> Recetas (<?php echo e($historial->recetas->count()); ?>)
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(route('certificados.create', $historial)); ?>" class="btn btn-info text-white">
                    <i class="fas fa-certificate me-1"></i> Certificado
                </a>
                <a href="<?php echo e(route('reposos.create', $historial)); ?>" class="btn btn-secondary text-white">
                    <i class="fas fa-bed me-1"></i> Reposo Médico
                </a>
                <a href="<?php echo e(route('reportes.historial', $historial)); ?>" target="_blank" class="btn btn-success text-white">
                    <i class="fas fa-print me-1"></i> Imprimir PDF
                </a>
            </div>

            <?php if(auth()->user()->hasAnyRole(['Administrador', 'Médico'])): ?>
            <button type="button" class="btn btn-outline-danger px-4 rounded-pill ms-md-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash me-1"></i> Eliminar
            </button>
            <?php endif; ?>
        </div>
    </div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/show/_acciones-historiales.blade.php ENDPATH**/ ?>