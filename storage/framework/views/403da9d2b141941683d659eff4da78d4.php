    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-danger bg-opacity-10 text-danger rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-heartbeat"></i></span>
                Signos Vitales
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                <?php
                    $vitales = [
                        ['label' => 'Presión Arterial', 'val' => $historial->presion_arterial, 'icon' => 'fa-tachometer-alt', 'color' => 'primary'],
                        ['label' => 'Frec. Cardíaca', 'val' => $historial->fc ? $historial->fc.' lpm' : null, 'icon' => 'fa-heart', 'color' => 'danger'],
                        ['label' => 'Sat O2', 'val' => $historial->sat ? $historial->sat.' %' : null, 'icon' => 'fa-lungs', 'color' => 'info'],
                        ['label' => 'Frec. Respiratoria', 'val' => $historial->fr ? $historial->fr.' rpm' : null, 'icon' => 'fa-wind', 'color' => 'secondary'],
                        ['label' => 'Temperatura', 'val' => $historial->temperatura ? $historial->temperatura.' °C' : null, 'icon' => 'fa-thermometer-half', 'color' => 'warning'],
                        ['label' => 'IMC', 'val' => $historial->imc ? $historial->imc.' kg/m²' : null, 'icon' => 'fa-weight', 'color' => 'success']
                    ];
                ?>
                <?php $__currentLoopData = $vitales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 col-lg-2">
                    <div class="border rounded-3 p-3 text-center h-100 bg-light transition-hover">
                        <i class="fas <?php echo e($vital['icon']); ?> text-<?php echo e($vital['color']); ?> mb-2 fs-5"></i>
                        <div class="small text-muted fw-semibold mb-1"><?php echo e($vital['label']); ?></div>
                        <div class="fw-bold text-dark"><?php echo e($vital['val'] ?? 'N/A'); ?></div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-warning bg-opacity-10 text-warning rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-file-medical-alt"></i></span>
                        Antecedentes Patológicos
                    </h6>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-3">
                        <?php
                            $patologicos = [
                                'hospitalizaciones' => 'Hospitalizaciones', 'cardiovasculares' => 'Cardiovasculares',
                                'pulmonales' => 'Pulmonares', 'digestivos' => 'Digestivos',
                                'diabetes' => 'Diabetes', 'renales' => 'Renales',
                                'quirurgicos' => 'Quirúrgicos', 'transfusiones' => 'Transfusiones',
                                'alergias_patologicas' => 'Alergias', 'otros_patologicos' => 'Otros'
                            ];
                        ?>
                        <ul class="list-group list-group-flush w-100">
                        <?php $__currentLoopData = $patologicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campo => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start px-0 bg-transparent border-light py-2">
                                <span class="text-muted small fw-medium"><?php echo e($label); ?></span>
                                <span class="text-dark text-end ms-3" style="font-size: 13px;"><?php echo e($historial->$campo ?? 'No registra'); ?></span>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- ========== ANTECEDENTES NO PATOLÓGICOS Y FAMILIARES ========== -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-success bg-opacity-10 text-success rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-leaf"></i></span>
                        No Patológicos y Familiares
                    </h6>
                </div>
                <div class="card-body p-4 pt-2">
                    <h6 class="small fw-bold text-muted text-uppercase mb-3">Hábitos</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <?php
                            $noPatologicos = [
                                'alcohol' => ['Alcohol', 'fa-glass-cheers'], 'tabaquismo' => ['Tabaquismo', 'fa-smoking'],
                                'drogas' => ['Drogas', 'fa-capsules'], 'inmunizaciones' => ['Inmunizaciones', 'fa-syringe'],
                                'otros_no_patologicos' => ['Otros', 'fa-asterisk']
                            ];
                        ?>
                        <?php $__currentLoopData = $noPatologicos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campo => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="border rounded px-3 py-2 bg-light w-100 d-flex justify-content-between">
                                <span class="small text-muted"><i class="fas <?php echo e($data[1]); ?> me-2 text-secondary"></i><?php echo e($data[0]); ?></span>
                                <span class="small text-dark"><?php echo e($historial->$campo ?? 'No registra'); ?></span>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <h6 class="small fw-bold text-muted text-uppercase mb-3 mt-4 border-top pt-3">Familiares</h6>
                    <?php if($historial->familiares_no_refiere): ?>
                        <div class="alert alert-light border text-muted small py-2"><i class="fas fa-info-circle me-2"></i>No refiere antecedentes familiares</div>
                    <?php else: ?>
                        <?php
                            $familiares = [
                                'familiar_hipertension' => 'Hipertensión', 'familiar_diabetes' => 'Diabetes',
                                'familiar_cardiopatias' => 'Cardiopatías', 'familiar_cancer' => 'Cáncer',
                                'familiar_obesidad' => 'Obesidad', 'familiar_dislipidemia' => 'Dislipidemia',
                                'familiar_enfermedad_renal' => 'Enf. Renal', 'familiar_enfermedad_tiroidea' => 'Enf. Tiroidea',
                                'familiar_enfermedad_mental' => 'Enf. Mental', 'familiar_tuberculosis' => 'Tuberculosis',
                                'familiar_alcoholismo' => 'Alcoholismo', 'familiar_otras' => 'Otras'
                            ];
                            $hayFamiliares = false;
                        ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = $familiares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campo => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($historial->$campo): ?>
                                    <?php $hayFamiliares = true; ?>
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-2 py-1 fw-normal">
                                        <i class="fas fa-check me-1"></i> <?php echo e($label); ?>

                                    </span>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$hayFamiliares): ?>
                                <div class="alert alert-light border text-muted small py-2 w-100"><i class="fas fa-info-circle me-2"></i>No refiere antecedentes familiares</div>
                            <?php endif; ?>
                        </div>
                        <?php if($historial->antecedentes_familiares): ?>
                            <div class="mt-3 p-3 bg-light rounded small text-dark border">
                                <strong class="text-muted d-block mb-1">Observaciones:</strong>
                                <?php echo e($historial->antecedentes_familiares); ?>

                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/show/_signos-antecedentes.blade.php ENDPATH**/ ?>