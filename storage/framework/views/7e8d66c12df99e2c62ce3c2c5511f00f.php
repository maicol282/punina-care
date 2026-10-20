<?php $__env->startSection('title', 'Detalles del Paciente'); ?>
<?php $__env->startSection('page-title', 'Perfil del Paciente'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('pacientes.partials.show._sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('pacientes.partials.show._historiales', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pacientes.partials.show._scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pacientes/show.blade.php ENDPATH**/ ?>