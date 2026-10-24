<?php $__env->startSection('title', 'Registrar Paciente'); ?>
<?php $__env->startSection('page-title', 'Registro de Paciente'); ?>
<?php $__env->startSection('breadcrumb', 'Nuevo Paciente'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Datos del Paciente</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('pacientes.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="row">
                <!-- COLUMNA IZQUIERDA - INFORMACIÓN PERSONAL -->
                <div class="col-md-6">
                    <?php echo $__env->make('pacientes.partials.create._informacion-personal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>

                <!-- COLUMNA DERECHA - UBICACIÓN Y OBSERVACIONES -->
                <div class="col-md-6">
                    <?php echo $__env->make('pacientes.partials.create._ubicacion', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('pacientes.partials.create._informacion-medica', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <?php echo $__env->make('pacientes.partials.create._facturacion', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="row mt-4">
                <div class="col-12 text-end">
                    <a href="<?php echo e(route('pacientes.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Guardar Paciente
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pacientes.partials.create._scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/create.blade.php ENDPATH**/ ?>