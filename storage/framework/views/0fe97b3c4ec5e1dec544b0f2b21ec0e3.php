<?php $__env->startSection('title', 'Mi Perfil'); ?>
<?php $__env->startSection('page-title', 'Editar Perfil'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>Mi Perfil</h5>
    </div>
    <div class="card-body">
        


        <!-- ===== FIRMA DIGITAL ===== -->
        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-signature me-2 text-primary"></i>Firma Digital</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php if(Auth::user()->firma_path): ?>
                            <div class="mb-3">
                                <label class="form-label">Firma actual</label>
                                <div>
                                    <img src="<?php echo e(asset('storage/' . Auth::user()->firma_path)); ?>" 
                                         alt="Firma" 
                                         style="max-height: 100px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo e(route('profile.update.firma')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            
                            <div class="mb-3">
                                <label class="form-label">Subir firma (PNG o JPG)</label>
                                <input type="file" name="firma" class="form-control" accept=".png,.jpg,.jpeg">
                                <small class="text-muted">La imagen debe ser transparente (fondo blanco). Tamaño recomendado: 300x100px.</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-1"></i> Guardar Firma
                            </button>
                            
                            <?php if(Auth::user()->firma_path): ?>
                                <a href="<?php echo e(route('profile.delete.firma')); ?>" class="btn btn-danger" 
                                   onclick="return confirm('¿Eliminar firma?')">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Recomendaciones:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Fondo blanco o transparente</li>
                                <li>Formato PNG (mejor calidad)</li>
                                <li>Tamaño máximo: 2MB</li>
                                <li>Dimensiones recomendadas: 300x100px</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/profile/edit.blade.php ENDPATH**/ ?>