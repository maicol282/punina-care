

<?php $__env->startSection('title', 'Detalle del Historial Clínico'); ?>
<?php $__env->startSection('page-title', 'Expediente Médico'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-0">
    
    <!-- ========== ENCABEZADO DEL PACIENTE ========== -->
    <?php echo $__env->make('historial.partials.show._encabezado-paciente', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- ========== DATOS DE LA CONSULTA ========== -->
    <?php echo $__env->make('historial.partials.show._datos-consulta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- ========== SECCIÓN: SIGNOS VITALES ========== -->
   <?php echo $__env->make('historial.partials.show._signos-antecedentes', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- ========== GINECO OBSTÉTRICOS (SI APLICA) ========== -->
   <?php echo $__env->make('historial.partials.show._gineco-obstetricos', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- ========== EXPLORACIÓN FÍSICA Y SISTEMAS ========== -->
   <?php echo $__env->make('historial.partials.show._exploracion-sistemas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- ========== DIAGNÓSTICOS, TRATAMIENTO Y ADJUNTOS ========== -->
    <?php echo $__env->make('historial.partials.show._diagnosticos-tratamiento', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <!-- ========== PANEL DE ACCIONES E HISTORIALES RELACIONADOS ========== -->
    <?php echo $__env->make('historial.partials.show._acciones-historiales', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>

<!-- ========== MODAL ELIMINAR ========== -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('historial.partials.show._modal-eliminar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php echo $__env->make('historial.partials.show._scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/show.blade.php ENDPATH**/ ?>