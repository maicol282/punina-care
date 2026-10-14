<?php $__env->startSection('title', 'Punina Care - Detalle de Consulta'); ?>
<?php $__env->startSection('page-title', 'Detalle de Consulta - Telemedicina'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-video me-2"></i>
            Consulta #<?php echo e($consulta->id); ?>

            <span class="badge bg-<?php echo e($consulta->estado_color); ?> ms-2"><?php echo e($consulta->estado_label); ?></span>
        </h5>
        <div>
            <span class="badge bg-light text-dark">Punina Care</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Información del Paciente -->
            <div class="col-md-6">
                <h6 class="fw-bold text-primary"><i class="fas fa-user me-2"></i>Paciente</h6>
                <hr>
                <p><strong>Nombre:</strong> <?php echo e($consulta->paciente->nombre); ?> <?php echo e($consulta->paciente->apellido); ?></p>
                <p><strong>Cédula:</strong> <?php echo e($consulta->paciente->cedula ?? 'N/E'); ?></p>
                <p><strong>Teléfono:</strong> <?php echo e($consulta->paciente->telefono ?? 'N/E'); ?></p>
                <p><strong>Email:</strong> <?php echo e($consulta->paciente->email ?? 'N/E'); ?></p>
            </div>

            <!-- Información del Médico -->
            <div class="col-md-6">
                <h6 class="fw-bold text-primary"><i class="fas fa-user-md me-2"></i>Médico</h6>
                <hr>
                <p><strong>Nombre:</strong> <?php echo e($consulta->medico->name); ?></p>
                <p><strong>Especialidad:</strong> <?php echo e($consulta->medico->especialidad ?? 'Médico General'); ?></p>
                <p><strong>Email:</strong> <?php echo e($consulta->medico->email); ?></p>
            </div>

            <!-- Información de la Consulta -->
            <div class="col-12 mt-3">
                <h6 class="fw-bold text-primary"><i class="fas fa-calendar-alt me-2"></i>Información de la Consulta</h6>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Fecha programada:</strong><br>
                            <span class="badge bg-light text-dark"><?php echo e($consulta->fecha_hora_programada->format('d/m/Y H:i')); ?></span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Duración:</strong> <?php echo e($consulta->duracion); ?> minutos</p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <strong>Estado:</strong>
                            <span class="badge bg-<?php echo e($consulta->estado_color); ?>"><?php echo e($consulta->estado_label); ?></span>
                        </p>
                    </div>
                    <?php if($consulta->fecha_inicio_real): ?>
                    <div class="col-md-4">
                        <p><strong>Inicio real:</strong> <?php echo e($consulta->fecha_inicio_real->format('d/m/Y H:i')); ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if($consulta->fecha_fin_real): ?>
                    <div class="col-md-4">
                        <p><strong>Fin real:</strong> <?php echo e($consulta->fecha_fin_real->format('d/m/Y H:i')); ?></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Motivo -->
            <div class="col-12 mt-3">
                <h6 class="fw-bold text-primary"><i class="fas fa-notes-medical me-2"></i>Motivo</h6>
                <hr>
                <p><?php echo e($consulta->motivo ?? 'No especificado'); ?></p>
            </div>

            <!-- Notas -->
            <?php if($consulta->notas): ?>
            <div class="col-12 mt-3">
                <h6 class="fw-bold text-primary"><i class="fas fa-comment me-2"></i>Notas</h6>
                <hr>
                <p><?php echo e($consulta->notas); ?></p>
            </div>
            <?php endif; ?>

            <!-- ===== ENLACE DE VIDEOLHAMADA CON BOTÓN COPIAR ===== -->
            <div class="col-12 mt-3">
                <div class="alert alert-success">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fas fa-link me-2"></i>
                        <strong>Enlace de videollamada:</strong>
                        <a href="<?php echo e($consulta->enlace_acceso); ?>" target="_blank" class="text-primary" id="enlaceVideollamada">
                            <?php echo e($consulta->enlace_acceso); ?>

                        </a>
                        <button type="button" class="btn btn-sm btn-outline-secondary ms-2" id="copiarEnlace" title="Copiar enlace">
                            <i class="fas fa-copy"></i> Copiar
                        </button>
                    </div>
                    <small class="text-muted">La videollamada se realiza a través de Jitsi Meet</small>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="<?php echo e(route('telemedicina.index')); ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
        <div>
            <?php if($consulta->estado == 'programada'): ?>
                <a href="<?php echo e(route('telemedicina.sala', $consulta)); ?>" class="btn btn-success" target="_blank">
                    <i class="fas fa-video me-1"></i> Iniciar Videollamada
                </a>
                <form action="<?php echo e(route('telemedicina.cancelar', $consulta)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Cancelar esta consulta?')">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                </form>
            <?php endif; ?>
            <?php if($consulta->estado == 'en_curso'): ?>
                <form action="<?php echo e(route('telemedicina.finalizar', $consulta)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check me-1"></i> Finalizar Consulta
                    </button>
                </form>
                <a href="<?php echo e($consulta->enlace_acceso); ?>" target="_blank" class="btn btn-success">
                    <i class="fas fa-video me-1"></i> Unirse a Videollamada
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== COPIAR ENLACE =====
    const btnCopiar = document.getElementById('copiarEnlace');
    const enlace = document.getElementById('enlaceVideollamada');

    if (btnCopiar && enlace) {
        btnCopiar.addEventListener('click', function() {
            const url = enlace.textContent.trim();
            
            // Usar navigator.clipboard si está disponible
            if (navigator.clipboard) {
                navigator.clipboard.writeText(url).then(function() {
                    mostrarToast('✅ Enlace copiado al portapapeles');
                }).catch(function() {
                    copiarUrlAlternativo(url);
                });
            } else {
                copiarUrlAlternativo(url);
            }
        });
    }

    function copiarUrlAlternativo(url) {
        // Método alternativo para navegadores antiguos
        const textarea = document.createElement('textarea');
        textarea.value = url;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        mostrarToast('✅ Enlace copiado al portapapeles');
    }

    function mostrarToast(mensaje) {
        // Crear toast simple
        const toast = document.createElement('div');
        toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3';
        toast.role = 'alert';
        toast.ariaLive = 'assertive';
        toast.ariaAtomic = 'true';
        toast.innerHTML = `
            <div class="d-flex">
                <div class="toast-body">
                    ${mensaje}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        `;
        document.body.appendChild(toast);
        
        const bsToast = new bootstrap.Toast(toast, { delay: 3000 });
        bsToast.show();
        
        toast.addEventListener('hidden.bs.toast', function() {
            toast.remove();
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/telemedicina/show.blade.php ENDPATH**/ ?>