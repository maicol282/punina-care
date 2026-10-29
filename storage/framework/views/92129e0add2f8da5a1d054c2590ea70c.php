<?php $__env->startSection('title', 'Política de Cookies'); ?>
<?php $__env->startSection('page-title', 'Política de Cookies'); ?>
<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h1 class="mb-4 text-primary fw-bold">Política de Cookies</h1>
            <p class="text-muted">Última actualización: <?php echo e(date('d/m/Y')); ?></p>
            <hr>
            <h4>¿Qué son las cookies?</h4>
            <p>Las cookies son pequeños archivos de texto que se almacenan en su navegador para recordar información sobre su visita.</p>
            <h4>¿Qué cookies utilizamos?</h4>
            <ul>
                <li><strong>Cookies esenciales:</strong> Necesarias para el funcionamiento del sistema (mantener la sesión iniciada, proteger contra ataques CSRF). Sin ellas, el sistema no puede funcionar.</li>
                <li><strong>Cookies de rendimiento:</strong> Nos ayudan a entender cómo se usa el sistema para mejorar la experiencia (opcionales).</li>
            </ul>
            <h4>¿Cómo desactivarlas?</h4>
            <p>Puede configurar su navegador para rechazar cookies, pero esto podría afectar el funcionamiento del sistema (no podrá iniciar sesión).</p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/legal/cookies.blade.php ENDPATH**/ ?>