    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-clinic-medical"></i></span>
                Resolución Clínica
            </h6>
        </div>
        <div class="card-body p-4">
            <h6 class="small fw-bold text-muted text-uppercase mb-3">Diagnósticos Registrados</h6>
            <?php if($historial->diagnosticos->count() > 0): ?>
                <div class="table-responsive mb-4">
                    <table class="table table-borderless align-middle rounded overflow-hidden">
                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="ps-3 py-3 rounded-start">Diagnóstico</th>
                                <th class="py-3">CIE-10</th>
                                <th class="py-3 rounded-end text-end pe-3">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $historial->diagnosticos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-bottom">
                                    <td class="ps-3 py-3 fw-medium text-dark"><?php echo e($diag->descripcion); ?></td>
                                    <td class="py-3"><span class="badge bg-light text-dark border"><?php echo e($diag->cie10_code ?? 'N/E'); ?></span></td>
                                    <td class="py-3 text-end pe-3">
                                        <span class="badge <?php echo e($diag->tipo == 'PRE' ? 'bg-warning text-dark' : 'bg-success'); ?> rounded-pill px-3">
                                            <?php echo e($diag->tipo == 'PRE' ? 'Presuntivo' : 'Definitivo'); ?>

                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-light border text-muted py-3 mb-4"><i class="fas fa-exclamation-circle me-2"></i>No hay diagnósticos registrados.</div>
            <?php endif; ?>

            <div class="row g-4 mt-2">
                <div class="col-md-6 border-end">
                    <h6 class="small fw-bold text-muted text-uppercase mb-2"><i class="fas fa-pills me-2 text-primary"></i>Plan de Tratamiento</h6>
                    <div class="p-3 bg-light rounded-3 text-dark border h-100" style="white-space: pre-wrap;"><?php echo e($historial->tratamiento ?? 'No registra'); ?></div>
                </div>
                <div class="col-md-6">
                    <h6 class="small fw-bold text-muted text-uppercase mb-2"><i class="fas fa-clipboard-list me-2 text-primary"></i>Recomendaciones</h6>
                    <div class="p-3 bg-light rounded-3 text-dark border h-100" style="white-space: pre-wrap;"><?php echo e($historial->recomendaciones ?? 'No registra'); ?></div>
                </div>
            </div>

           
            
            <?php if($historial->observaciones): ?>
            <div class="mt-4 pt-3 border-top">
                <h6 class="small fw-bold text-muted text-uppercase mb-2"><i class="fas fa-comment-dots me-2 text-primary"></i>Observaciones Generales</h6>
                <p class="text-dark small mb-0"><?php echo e($historial->observaciones); ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/show/_diagnosticos-tratamiento.blade.php ENDPATH**/ ?>