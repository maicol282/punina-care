    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <i class="fas fa-user-circle fa-2x text-primary me-3"></i>
                    <strong class="fs-5"><?php echo e($paciente->nombre_completo); ?></strong>
                    <span class="badge bg-secondary ms-2"><?php echo e($paciente->edad); ?> años</span>
                    <span class="badge bg-info ms-1">Cédula: <?php echo e($paciente->cedula ?? 'N/A'); ?></span>
                    <span class="badge bg-info ms-2" data-bs-toggle="tooltip" title="">
                <i class="fas fa-info-circle"></i> Todos los campos se llenan por defecto si no son llenados por información.
            </span>
                    
                </div>
                <span class="badge bg-light text-dark px-3 py-2 border mt-2 mt-sm-0"><?php echo e($paciente->historialClinicos->count()); ?> historiales previos</span>
            </div>
            <input type="hidden" id="fecha_nacimiento_paciente" value="<?php echo e($paciente->fecha_nacimiento ?? ''); ?>">
        </div>
    </div>

    <form action="<?php echo e(route('historial.store', $paciente)); ?>" method="POST">
        <?php echo csrf_field(); ?>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/_info-paciente.blade.php ENDPATH**/ ?>