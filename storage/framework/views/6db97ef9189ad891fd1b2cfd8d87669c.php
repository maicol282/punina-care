

<?php $__env->startSection('title', 'Detalle del Historial Clínico'); ?>
<?php $__env->startSection('page-title', 'Expediente Médico'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-0">
    
    <!-- ========== ENCABEZADO DEL PACIENTE ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-4" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-injured fa-2x text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1"><?php echo e($historial->paciente->nombre_completo); ?></h4>
                        <div class="d-flex flex-wrap gap-2 align-items-center" style="font-size: 13px;">
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-id-card me-1"></i> <?php echo e($historial->paciente->cedula ?? 'S/C'); ?></span>
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-birthday-cake me-1"></i> <?php echo e($historial->paciente->edad); ?> años</span>
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-phone me-1"></i> <?php echo e($historial->paciente->telefono ?? 'N/A'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="badge bg-white text-primary px-3 py-2 rounded-pill fs-6 mb-1 shadow-sm">
                        <i class="fas fa-id-card me-2"></i>
                        <?php echo e($historial->paciente->cedula ?? 'SIN-CÉDULA'); ?>

                        <span class="mx-2">|</span>
                        <i class="far fa-calendar-alt me-1"></i>
                        <?php echo e($historial->fecha_consulta->format('Ymd')); ?>

                    </div>
                    <div class="text-white-50 small"><i class="far fa-calendar-alt me-1"></i> <?php echo e($historial->fecha_consulta->format('d/m/Y')); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== DATOS DE LA CONSULTA ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-stethoscope"></i></span>
                Datos de la Consulta
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-3">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Fecha</span>
                    <span class="text-dark fw-medium"><?php echo e($historial->fecha_consulta->format('d/m/Y')); ?></span>
                </div>
                <div class="col-md-3">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Doctor Responsable</span>
                    <span class="text-dark fw-medium"><i class="fas fa-user-md text-primary me-1"></i> <?php echo e($historial->doctor ?? 'No registrado'); ?></span>
                </div>
                <div class="col-md-6">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Motivo de Consulta</span>
                    <div class="p-3 bg-light rounded-3 text-dark border"><?php echo e($historial->motivo_consulta ?? 'No registrado'); ?></div>
                </div>
                <div class="col-12 mt-4">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Enfermedad Actual</span>
                    <p class="text-dark mb-0 lh-lg"><?php echo e($historial->enfermedad_actual ?? 'No registra'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== SECCIÓN: SIGNOS VITALES ========== -->
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

    <!-- ========== GINECO OBSTÉTRICOS (SI APLICA) ========== -->
    <?php if($historial->paciente->genero == 'F' || $historial->paciente->genero == 'Otro'): ?>
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-info bg-opacity-10 text-info rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-venus"></i></span>
                Antecedentes Gineco Obstétricos
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3 text-center">
                <?php
                    $gineco = [
                        'menarquia' => 'Menarquia', 'ritmo' => 'Ritmo', 'fmu' => 'F.M.U', 'menopausia' => 'Menopausia',
                        'gestas' => 'Gestas', 'partos' => 'Partos', 'abortos' => 'Abortos', 'cesareas' => 'Cesáreas',
                        'hijos_vivos' => 'Hijos Vivos', 'num_parejas_sexuales' => 'Parejas Sex.'
                    ];
                ?>
                <?php $__currentLoopData = $gineco; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campo => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 col-lg-2 col-6 border-end border-bottom pb-3">
                        <span class="d-block text-muted small fw-semibold"><?php echo e($label); ?></span>
                        <span class="text-dark fw-bold fs-6"><?php echo e($historial->$campo ?? '-'); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 text-start pt-3 border-top">
                    <span class="text-muted small fw-semibold me-2">Usa Anticonceptivos:</span>
                    <span class="badge <?php echo e($historial->usa_anticonceptivos ? 'bg-success' : 'bg-secondary'); ?> rounded-pill px-3"><?php echo e($historial->usa_anticonceptivos ? 'Sí' : 'No'); ?></span>
                    <?php if($historial->usa_anticonceptivos): ?>
                        <div class="mt-1 small text-dark"><strong>Cuáles:</strong> <?php echo e($historial->cuales_anticonceptivos ?? 'No especifica'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ========== EXPLORACIÓN FÍSICA Y SISTEMAS ========== -->
    <div class="row">
        <!-- EXPLORACIÓN FÍSICA -->
        <?php
            $exploraciones = [
                ['id' => 'cabeza', 'label' => 'Cabeza'], ['id' => 'cuello', 'label' => 'Cuello'],
                ['id' => 'torax', 'label' => 'Tórax'], ['id' => 'abdomen', 'label' => 'Abdomen'],
                ['id' => 'extremidades', 'label' => 'Extremidades'], ['id' => 'neurologico', 'label' => 'Neurológico'],
                ['id' => 'piel', 'label' => 'Piel'], ['id' => 'columna', 'label' => 'Columna'],
                ['id' => 'pelvis', 'label' => 'Pelvis'], ['id' => 'axilas', 'label' => 'Axilas'],
                ['id' => 'mamas', 'label' => 'Mamas']
            ];
            $tieneCP = collect($exploraciones)->contains(fn($e) => ($historial->{$e['id'].'_tipo'} ?? 'SP') === 'CP');
        ?>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-male"></i></span>
                        Exploración Física
                    </h6>
                    <span class="badge <?php echo e($tieneCP ? 'bg-danger' : 'bg-success'); ?> rounded-pill fw-normal"><?php echo e($tieneCP ? 'Hallazgos patológicos' : 'Sin alteraciones'); ?></span>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-2">
                        <?php $__currentLoopData = $exploraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exploracion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $campoTipo = $exploracion['id'] . '_tipo';
                                $esCP = ($historial->$campoTipo ?? 'SP') === 'CP';
                                $observacion = $historial->{$exploracion['id']} ?? '';
                            ?>
                            <div class="col-md-6">
                                <div class="border rounded px-3 py-2 h-100 <?php echo e($esCP ? 'border-danger bg-danger bg-opacity-10' : 'bg-light border-light'); ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small fw-semibold <?php echo e($esCP ? 'text-danger' : 'text-muted'); ?>"><?php echo e($exploracion['label']); ?></span>
                                        <span class="badge <?php echo e($esCP ? 'bg-danger' : 'bg-secondary bg-opacity-25 text-secondary'); ?>" style="font-size: 10px;"><?php echo e($esCP ? 'CP' : 'SP'); ?></span>
                                    </div>
                                    <?php if($esCP && $observacion): ?>
                                        <div class="text-dark mt-1" style="font-size: 12px; line-height: 1.3;"><?php echo e($observacion); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- REVISIÓN DE SISTEMAS -->
        <?php
            $sistemas = [
                ['id' => 'cardiovascular', 'label' => 'Cardiovascular'], ['id' => 'respiratorio', 'label' => 'Respiratorio'],
                ['id' => 'digestivo', 'label' => 'Digestivo'], ['id' => 'renal', 'label' => 'Renal'],
                ['id' => 'neurologico', 'label' => 'Neurológico'], ['id' => 'musculoesqueletico', 'label' => 'Musculoesquelético'],
                ['id' => 'endocrino', 'label' => 'Endocrino'], ['id' => 'hematologico', 'label' => 'Hematológico'],
                ['id' => 'linfatico', 'label' => 'Linfático'], ['id' => 'genitourinario', 'label' => 'Genitourinario'],
                ['id' => 'piel', 'label' => 'Piel/Anexos'], ['id' => 'oftalmologico', 'label' => 'Oftalmológico'],
                ['id' => 'orl', 'label' => 'Otorrinolaringológico'], ['id' => 'psiquiatrico', 'label' => 'Psiquiátrico']
            ];
            $tieneCPSistemas = collect($sistemas)->contains(fn($s) => ($historial->{'sist_'.$s['id']} ?? 'SP') === 'CP');
        ?>
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-secondary bg-opacity-10 text-secondary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-project-diagram"></i></span>
                        Órganos y Sistemas
                    </h6>
                    <span class="badge <?php echo e($tieneCPSistemas ? 'bg-danger' : 'bg-success'); ?> rounded-pill fw-normal"><?php echo e($tieneCPSistemas ? 'Hallazgos patológicos' : 'Sin alteraciones'); ?></span>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-2">
                        <?php $__currentLoopData = $sistemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sistema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $campo = 'sist_' . $sistema['id'];
                                $esCP = ($historial->$campo ?? 'SP') === 'CP';
                                $observacion = $historial->{$campo.'_obs'} ?? '';
                            ?>
                            <div class="col-md-6">
                                <div class="border rounded px-3 py-2 h-100 <?php echo e($esCP ? 'border-danger bg-danger bg-opacity-10' : 'bg-light border-light'); ?>">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small fw-semibold <?php echo e($esCP ? 'text-danger' : 'text-muted'); ?>"><?php echo e($sistema['label']); ?></span>
                                        <span class="badge <?php echo e($esCP ? 'bg-danger' : 'bg-secondary bg-opacity-25 text-secondary'); ?>" style="font-size: 10px;"><?php echo e($esCP ? 'CP' : 'SP'); ?></span>
                                    </div>
                                    <?php if($esCP && $observacion): ?>
                                        <div class="text-dark mt-1" style="font-size: 12px; line-height: 1.3;"><?php echo e($observacion); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if($historial->observaciones_sistemas): ?>
                        <div class="mt-3 p-3 bg-light rounded border small text-dark">
                            <strong class="text-primary d-block mb-1"><i class="fas fa-info-circle me-1"></i> Observaciones adicionales:</strong>
                            <?php echo e($historial->observaciones_sistemas); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== DIAGNÓSTICOS, TRATAMIENTO Y ADJUNTOS ========== -->
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

            <div class="row g-4 mt-2 border-top pt-2">
                <div class="col-12">
                    <h6 class="small fw-bold text-muted text-uppercase mb-3 mt-3"><i class="fas fa-microscope me-2 text-primary"></i>Estudios Complementarios & Adjuntos</h6>
                    <div class="row g-3">
                        <?php $__currentLoopData = ['Laboratorio' => ['flask', 'primary'], 'Imagen' => ['x-ray', 'info'], 'Otros' => ['folder-open', 'secondary']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4">
                            <div class="border rounded-3 p-3 h-100 bg-light border-light">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-<?php echo e($icon[0]); ?> text-<?php echo e($icon[1]); ?>"></i>
                                    <span class="fw-bold text-dark small"><?php echo e($categoria); ?></span>
                                </div>
                                <?php $campoTexto = strtolower($categoria) == 'otros' ? 'otros_exploracion' : (strtolower($categoria) == 'imagen' ? 'estudio_imagen' : strtolower($categoria)); ?>
                                <p class="small text-muted mb-3"><?php echo e($historial->$campoTexto ?? 'No requiere'); ?></p>
                                
                                <?php if($historial->estudiosAdjuntos->where('categoria', $categoria)->count() > 0): ?>
                                    <div class="d-flex flex-wrap gap-2">
                                        <?php $__currentLoopData = $historial->estudiosAdjuntos->where('categoria', $categoria); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjunto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('adjuntos.download', $adjunto)); ?>" target="_blank" class="btn btn-sm btn-white border shadow-sm rounded-pill py-1 px-3" style="font-size: 11px;">
                                                <i class="fas <?php echo e($adjunto->icono); ?> text-<?php echo e($adjunto->color); ?> me-1"></i> <?php echo e(Str::limit($adjunto->nombre_original, 15)); ?>

                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
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

    <!-- ========== PANEL DE ACCIONES E HISTORIALES RELACIONADOS ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-5" style="background-color: var(--gray-bg);">
        <div class="card-body p-4 text-center d-flex flex-wrap justify-content-center gap-2">
            <a href="<?php echo e(route('pacientes.show', $historial->paciente->id)); ?>" class="btn btn-light border px-4 rounded-pill shadow-sm text-dark fw-medium">
                <i class="fas fa-arrow-left me-2"></i> Volver al Paciente
            </a>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar historiales')): ?>
            <a href="<?php echo e(route('historial.edit', $historial->id)); ?>" class="btn btn-warning px-4 rounded-pill shadow-sm text-dark fw-medium">
                <i class="fas fa-edit me-1"></i> Editar Historial
            </a>
            <?php endif; ?>
            
            <!-- Recetas / Certificados / Reposos -->
            <div class="btn-group shadow-sm ms-md-auto">
                <?php if($historial->recetas->count() > 0): ?>
                    <a href="<?php echo e(route('recetas.index', $historial)); ?>" class="btn" style="background-color: #6366f1; color: white;">
                        <i class="fas fa-prescription-bottle-alt me-1"></i> Recetas (<?php echo e($historial->recetas->count()); ?>)
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(route('certificados.create', $historial)); ?>" class="btn btn-info text-white">
                    <i class="fas fa-certificate me-1"></i> Certificado
                </a>
                <a href="<?php echo e(route('reposos.create', $historial)); ?>" class="btn btn-secondary text-white">
                    <i class="fas fa-bed me-1"></i> Reposo Médico
                </a>
                <a href="<?php echo e(route('reportes.historial', $historial)); ?>" target="_blank" class="btn btn-success text-white">
                    <i class="fas fa-print me-1"></i> Imprimir PDF
                </a>
            </div>

            <?php if(auth()->user()->hasAnyRole(['Administrador', 'Médico'])): ?>
            <button type="button" class="btn btn-outline-danger px-4 rounded-pill ms-md-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash me-1"></i> Eliminar
            </button>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- ========== MODAL ELIMINAR ========== -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-danger text-white border-0 p-4">
                <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <i class="fas fa-trash-alt fa-3x text-danger opacity-50 mb-3"></i>
                <p class="fs-5 text-dark mb-1">¿Estás seguro de eliminar este historial?</p>
                <p class="text-muted small mb-0">Esta acción es irreversible y eliminará todos los registros, recetas y adjuntos asociados.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 border" data-bs-dismiss="modal">Cancelar</button>
                <form action="<?php echo e(route('historial.destroy', $historial->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm">Sí, Eliminar Historial</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .transition-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .transition-hover:hover { transform: translateY(-3px); box-shadow: var(--shadow-sm); }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'rounded-pill px-4',
                cancelButton: 'rounded-pill px-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/show.blade.php ENDPATH**/ ?>