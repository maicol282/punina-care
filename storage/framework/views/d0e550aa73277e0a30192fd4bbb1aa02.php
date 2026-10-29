<?php $__env->startSection('title', 'Términos y Condiciones'); ?>
<?php $__env->startSection('page-title', 'Términos y Condiciones'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h1 class="mb-4 text-primary fw-bold">Términos y Condiciones de Uso</h1>
            <p class="text-muted">Última actualización: <?php echo e(date('d/m/Y')); ?></p>
            <hr>
            <h4>1. Aceptación de los Términos</h4>
            <p>Al acceder y utilizar el sistema <strong>Punina Care</strong>, usted acepta cumplir con estos Términos y Condiciones. Este sistema es una herramienta de apoyo clínico y no reemplaza el juicio profesional del médico.</p>
            <h4>2. Uso del Sistema</h4>
            <p>El sistema está destinado exclusivamente para el personal médico autorizado. El usuario es responsable de mantener la confidencialidad de sus credenciales de acceso (cédula y contraseña).</p>
            <h4>3. Responsabilidad Médica</h4>
            <p>Punina Care es un software de gestión de historiales clínicos. La responsabilidad sobre los diagnósticos, tratamientos y decisiones médicas recae exclusivamente en el profesional de la salud que utiliza el sistema.</p>
            <h4>4. Propiedad Intelectual</h4>
            <p>El código fuente, diseño y lógica del sistema son propiedad del desarrollador. Queda prohibida su reproducción total o parcial sin autorización.</p>
            <h4>5. Modificaciones</h4>
            <p>Nos reservamos el derecho de modificar estos términos en cualquier momento. Las modificaciones entrarán en vigencia al ser publicadas en esta página.</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/legal/terminos.blade.php ENDPATH**/ ?>