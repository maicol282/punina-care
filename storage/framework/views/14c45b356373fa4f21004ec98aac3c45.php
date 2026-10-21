

<?php $__env->startSection('title', 'Nuevo Historial Clínico'); ?>
<div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
    <div>
        <i class="fas fa-file-medical me-2 text-primary"></i> 
        <span class="fw-semibold">Registrar Nuevo Historial Clínico</span>
        <?php if($paciente->historialClinicos->count() > 0): ?>
            <span class="badge bg-info ms-2">Historiales previos: <?php echo e($paciente->historialClinicos->count()); ?></span>
        <?php endif; ?>
    </div>
    <div>
        <?php if($paciente->historialClinicos->count() > 0): ?>
            <button type="button" class="btn btn-warning btn-sm" id="btnCopiarHistorialAnterior" title="Copiar datos del último historial">
                <i class="fas fa-copy me-1"></i> Copiar último historial
            </button>
        <?php endif; ?>
    </div>
</div>
<?php $__env->startSection('page-title', 'Registrar Nuevo Historial Clínico'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-0">
    <!-- Información del paciente -->
<?php echo $__env->make('historial.partials._info-paciente', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php echo $__env->make('historial.partials._datos-consulta', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
  <?php echo $__env->make('historial.partials._antecedentes-patologicos', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== ANTECEDENTES PERSONALES NO PATOLÓGICOS ========== -->
        <?php echo $__env->make('historial.partials._antecedentes-no-patologicos', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== ANTECEDENTES FAMILIARES ========== -->
        <?php echo $__env->make('historial.partials._antecedentes-familiares', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== GINECO OBSTÉTRICOS ========== -->
                <?php echo $__env->make('historial.partials._gineco-obstetricos', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- ========== ENFERMEDAD ACTUAL ========== -->
               <?php echo $__env->make('historial.partials._enfermedad-actual', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== SIGNOS VITALES ========== -->
        <?php echo $__env->make('historial.partials._signos-vitales', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== EXPLORACIÓN FÍSICA ========== -->
        <?php echo $__env->make('historial.partials._exploracion-fisica', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== REVISIÓN DE ÓRGANOS Y SISTEMAS ========== -->
        <?php echo $__env->make('historial.partials._revision-sistemas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- ========== ESTUDIOS COMPLEMENTARIOS ========== -->
        <?php echo $__env->make('historial.partials._estudios-complementarios', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<!-- ========== DIAGNÓSTICOS ========== -->
        <?php echo $__env->make('historial.partials._diagnosticos', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== TRATAMIENTO Y RECOMENDACIONES ========== -->
        <?php echo $__env->make('historial.partials._tratamiento', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- ========== OBSERVACIONES ========== -->
        <?php echo $__env->make('historial.partials._observaciones', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <!-- BOTONES -->
                <?php echo $__env->make('historial.partials._botones-accion', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('historial.partials._scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/create.blade.php ENDPATH**/ ?>