        <!-- ========== DATOS DE LA CONSULTA ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-notes-medical me-2 text-primary"></i> Datos de la Consulta
                <span class="badge bg-secondary ms-2">Todos los campos con * son oblogatorios.</span>
                
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Fecha Consulta <span class="text-danger">*</span></label>
                        <input type="date" name="fecha_consulta" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Doctor Responsable</label>
                        <select name="doctor" class="form-select">
                            <option value="">Seleccione un médico</option>
                            <?php $__currentLoopData = $medicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($medico->name); ?>"><?php echo e($medico->name); ?> <?php if($medico->especialidad): ?> - <?php echo e($medico->especialidad); ?> <?php endif; ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Motivo de Consulta <span class="text-danger">*</span></label>
                        <textarea name="motivo_consulta" class="form-control" rows="2" placeholder="Describa el motivo..." required></textarea>
                    </div>
                </div>
            </div>
        </div>

<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/_datos-consulta.blade.php ENDPATH**/ ?>