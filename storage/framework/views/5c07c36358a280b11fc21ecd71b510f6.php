<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-microscope me-2 text-primary"></i> 
            <span class="fw-semibold">Estudios Complementarios</span>
            <span class="badge bg-info ms-2">Archivos adjuntos</span>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="toggleEstudios">
            <i class="fas fa-chevron-up me-1"></i> Contraer
        </button>
    </div>
    <div class="card-body" id="estudiosContainer">
        <?php
            $categorias = [
                'Laboratorio' => ['texto' => $historial->laboratorio, 'archivos' => $historial->estudiosAdjuntos->where('categoria', 'Laboratorio')],
                'Imagen' => ['texto' => $historial->estudio_imagen, 'archivos' => $historial->estudiosAdjuntos->where('categoria', 'Imagen')],
                'Otros' => ['texto' => $historial->otros_exploracion, 'archivos' => $historial->estudiosAdjuntos->where('categoria', 'Otros')],
            ];
        ?>

        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nombre => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($data['texto']) || $data['archivos']->count() > 0): ?>
                <div class="row g-2 mb-3">
                    <div class="col-12">
                        <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                            <div class="row g-2 align-items-start">
                                <div class="col-md-5">
                                    <div class="d-flex align-items-center gap-2">
                                        <?php if($nombre == 'Laboratorio'): ?> <i class="fas fa-flask text-primary" style="font-size: 14px;"></i>
                                        <?php elseif($nombre == 'Imagen'): ?> <i class="fas fa-x-ray text-primary" style="font-size: 14px;"></i>
                                        <?php else: ?> <i class="fas fa-folder-open text-primary" style="font-size: 14px;"></i>
                                        <?php endif; ?>
                                        <label class="form-label fw-semibold mb-0 small"><?php echo e($nombre); ?></label>
                                    </div>
                                    <p class="small text-muted mt-1 mb-0"><?php echo e($data['texto'] ?? 'Sin descripción.'); ?></p>
                                </div>
                                <div class="col-md-7">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                        <span class="small text-muted">Archivos adjuntos (<?php echo e($data['archivos']->count()); ?>)</span>
                                    </div>
                                    
                                    <?php if($data['archivos']->count() > 0): ?>
                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                            <?php $__currentLoopData = $data['archivos']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('adjuntos.ver', $adjunto->id)); ?>" target="_blank" class="text-decoration-none border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px; color: inherit;" id="archivo-<?php echo e($adjunto->id); ?>">
                                                    <i class="fas <?php echo e($adjunto->icono); ?> text-<?php echo e($adjunto->color); ?>" style="font-size: 12px;"></i>
                                                    <span style="max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo e($adjunto->nombre_original); ?></span>
                                                    <i class="fas fa-eye text-primary ms-1" style="font-size: 10px;"></i>
                                                </a>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="small text-muted fst-italic">No hay archivos adjuntos.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(empty($historial->laboratorio) && empty($historial->estudio_imagen) && empty($historial->otros_exploracion) && $historial->estudiosAdjuntos->count() == 0): ?>
            <p class="text-muted small text-center mb-0">No se registraron estudios complementarios en esta consulta.</p>
        <?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleEstudios');
    const container = document.getElementById('estudiosContainer');
    if (toggleBtn && container) {
        toggleBtn.addEventListener('click', function() {
            if (container.style.display === 'none') {
                container.style.display = 'block';
                this.innerHTML = '<i class="fas fa-chevron-up me-1"></i> Contraer';
            } else {
                container.style.display = 'none';
                this.innerHTML = '<i class="fas fa-chevron-down me-1"></i> Expandir';
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/show/_estudios-complementarios.blade.php ENDPATH**/ ?>