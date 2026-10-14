<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-microscope me-2 text-primary"></i> 
            <span class="fw-semibold">Estudios Complementarios</span>
            <span class="badge bg-info ms-2">Adjunta imágenes y PDFs</span>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="toggleEstudios">
            <i class="fas fa-chevron-up me-1"></i> Contraer
        </button>
    </div>
    <div class="card-body" id="estudiosContainer">
        <!-- ===== LABORATORIO ===== -->
        <div class="row g-2 mb-3">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-flask text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Laboratorio</label>
                                <span class="badge bg-light text-muted" id="count-laboratorio">0 archivos</span>
                            </div>
                            <textarea name="laboratorio" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa los exámenes de laboratorio..."><?php echo e(old('laboratorio', $historial->laboratorio ?? '')); ?></textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            <!-- Archivos existentes -->
                            <?php if(isset($historial) && $historial->estudiosAdjuntos->where('categoria', 'Laboratorio')->count() > 0): ?>
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    <?php $__currentLoopData = $historial->estudiosAdjuntos->where('categoria', 'Laboratorio'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-<?php echo e($adjunto->id); ?>">
                                            <i class="fas <?php echo e($adjunto->icono); ?> text-<?php echo e($adjunto->color); ?>" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo e($adjunto->nombre_original); ?></span>
                                            <?php if(Route::currentRouteName() == 'historial.edit'): ?>
                                                <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="<?php echo e($adjunto->id); ?>" style="font-size: 10px; line-height: 1;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Drop zone -->
                            <div class="drop-zone-laboratorio border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-laboratorio" name="archivos_laboratorio[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx" style="display: none;">
                            </div>
                            <div class="file-list-laboratorio d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== ESTUDIO DE IMAGEN ===== -->
        <div class="row g-2 mb-3">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-x-ray text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Estudio de Imagen</label>
                                <span class="badge bg-light text-muted" id="count-imagen">0 archivos</span>
                            </div>
                            <textarea name="estudio_imagen" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa los estudios de imagen..."><?php echo e(old('estudio_imagen', $historial->estudio_imagen ?? '')); ?></textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            <?php if(isset($historial) && $historial->estudiosAdjuntos->where('categoria', 'Imagen')->count() > 0): ?>
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    <?php $__currentLoopData = $historial->estudiosAdjuntos->where('categoria', 'Imagen'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-<?php echo e($adjunto->id); ?>">
                                            <i class="fas <?php echo e($adjunto->icono); ?> text-<?php echo e($adjunto->color); ?>" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo e($adjunto->nombre_original); ?></span>
                                            <?php if(Route::currentRouteName() == 'historial.edit'): ?>
                                                <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="<?php echo e($adjunto->id); ?>" style="font-size: 10px; line-height: 1;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <div class="drop-zone-imagen border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-imagen" name="archivos_imagen[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" style="display: none;">
                            </div>
                            <div class="file-list-imagen d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== OTROS ===== -->
        <div class="row g-2">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-folder-open text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Otros Estudios</label>
                                <span class="badge bg-light text-muted" id="count-otros">0 archivos</span>
                            </div>
                            <textarea name="otros_exploracion" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa otros estudios complementarios..."><?php echo e(old('otros_exploracion', $historial->otros_exploracion ?? '')); ?></textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            <?php if(isset($historial) && $historial->estudiosAdjuntos->where('categoria', 'Otros')->count() > 0): ?>
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    <?php $__currentLoopData = $historial->estudiosAdjuntos->where('categoria', 'Otros'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-<?php echo e($adjunto->id); ?>">
                                            <i class="fas <?php echo e($adjunto->icono); ?> text-<?php echo e($adjunto->color); ?>" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo e($adjunto->nombre_original); ?></span>
                                            <?php if(Route::currentRouteName() == 'historial.edit'): ?>
                                                <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="<?php echo e($adjunto->id); ?>" style="font-size: 10px; line-height: 1;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <div class="drop-zone-otros border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-otros" name="archivos_otros[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx" style="display: none;">
                            </div>
                            <div class="file-list-otros d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/_estudios-complementarios.blade.php ENDPATH**/ ?>