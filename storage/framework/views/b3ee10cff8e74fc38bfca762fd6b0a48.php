<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historial Clínico - <?php echo e($historial->paciente->nombre_completo); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            margin: 15px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 20px;
            color: #2c3e50;
            margin: 0;
        }
        .header p {
            font-size: 10px;
            color: #666;
            margin: 5px 0;
        }
        .info-section {
            background: #f5f5f5;
            padding: 10px 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .info-section h6 {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px;
            vertical-align: top;
        }
        .label {
            font-weight: bold;
            width: 20%;
        }
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .section-title {
            background: #3498db;
            color: white;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .section-title-green {
            background: #27ae60;
        }
        .section-title-orange {
            background: #f39c12;
        }
        .section-title-red {
            background: #e74c3c;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .data-table td {
            padding: 6px;
            vertical-align: top;
            border: 1px solid #e0e0e0;
            background: #fafafa;
        }
        .grid-2 {
            width: 100%;
            border-collapse: collapse;
        }
        .grid-2 td {
            padding: 6px;
            vertical-align: top;
            width: 50%;
            border: 1px solid #e0e0e0;
            background: #fafafa;
        }
        .grid-3 {
            width: 100%;
            border-collapse: collapse;
        }
        .grid-3 td {
            padding: 6px;
            vertical-align: top;
            width: 33.33%;
            border: 1px solid #e0e0e0;
            background: #fafafa;
        }
        .grid-4 {
            width: 100%;
            border-collapse: collapse;
        }
        .grid-4 td {
            padding: 6px;
            vertical-align: top;
            width: 25%;
            border: 1px solid #e0e0e0;
            background: #fafafa;
        }
        .field-label {
            font-weight: bold;
            font-size: 9px;
            color: #555;
            display: block;
            margin-bottom: 4px;
            text-transform: uppercase;
        }
        .field-value {
            font-size: 10px;
            color: #333;
            word-break: break-word;
        }
        .firma {
            margin-top: 30px;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        hr {
            margin: 10px 0;
        }
        .badge {
            background: #2c3e50;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 9px;
            display: inline-block;
            margin-bottom: 5px;
        }
        .badge-green {
            background: #27ae60;
        }
        .badge-red {
            background: #e74c3c;
        }
        .badge-orange {
            background: #f39c12;
        }
        .badge-blue {
            background: #3498db;
        }
        .page-break {
            page-break-before: always;
        }
        .text-center {
            text-align: center;
        }
        .alert-danger {
            background: linear-gradient(135deg, #ffe6e6 0%, #ffcccc 100%);
            border-left: 4px solid #e74c3c;
            padding: 8px 12px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .alert-danger strong {
            color: #e74c3c;
        }
        .familiar-badge {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 9px;
            margin: 2px 4px 2px 0;
        }
    </style>
</head>
<body>

<!-- ==================== HEADER ==================== -->
<div class="header">
    <h1>HISTORIAL CLÍNICO</h1>
    <p>Sistema de Gestión Médica</p>
    <p>Fecha de emisión: <?php echo e(date('d/m/Y H:i:s')); ?></p>
</div>

<!-- ==================== DATOS DEL PACIENTE ==================== -->
<div class="info-section">
    <h6>[DATOS DEL PACIENTE]</h6>
    <table class="info-table">
        <tr>
            <td class="label">Nombre Completo:</td>
            <td><?php echo e($historial->paciente->nombre_completo); ?></td>
            <td class="label">Edad:</td>
            <td><?php echo e($historial->paciente->edad); ?> años</td>
        </tr>
        <tr>
            <td class="label">Cédula:</td>
            <td><?php echo e($historial->paciente->cedula ?? 'No registrada'); ?></td>
            <td class="label">Género:</td>
            <td><?php echo e($historial->paciente->genero == 'M' ? 'Masculino' : 'Femenino'); ?></td>
        </tr>
        <tr>
            <td class="label">Teléfono:</td>
            <td><?php echo e($historial->paciente->telefono ?? 'No registrado'); ?></td>
            <td class="label">Email:</td>
            <td><?php echo e($historial->paciente->email ?? 'No registrado'); ?></td>
        </tr>
        <tr>
            <td class="label">Dirección:</td>
            <td colspan="3"><?php echo e($historial->paciente->direccion ?? 'No registrada'); ?></td>
        </tr>
    </table>
</div>

<!-- ==================== ALERTA DE ALERGIAS ==================== -->
<?php if($historial->paciente->alergias): ?>
<div class="alert-danger">
    <strong>⚠️ ALERTA DE ALERGIA:</strong> Este paciente presenta alergia a: <?php echo e($historial->paciente->alergias); ?>

</div>
<?php endif; ?>

<!-- ==================== DATOS DE LA CONSULTA ==================== -->
<div class="info-section">
    <h6>[DATOS DE LA CONSULTA]</h6>
    <table class="info-table">
        <tr>
            <td class="label">Fecha Consulta:</td>
            <td><?php echo e($historial->fecha_consulta->format('d/m/Y')); ?></td>
            <td class="label">Doctor:</td>
            <td><?php echo e($historial->doctor ?? 'No especificado'); ?></td>
        </tr>
        <tr>
            <td class="label">Motivo:</td>
            <td colspan="3"><?php echo e($historial->motivo_consulta ?? 'No registrado'); ?></td>
        </tr>
    </table>
</div>



<!-- ==================== ANTECEDENTES PATOLÓGICOS ==================== -->
<div class="section">
    <div class="section-title">[ANTECEDENTES PERSONALES PATOLÓGICOS]</div>
    <table class="grid-2">
        <tr>
            <td><span class="field-label">Hospitalizaciones</span><span class="field-value"><?php echo e($historial->hospitalizaciones ?? 'No registra'); ?></span></td>
            <td><span class="field-label">Cardiovasculares</span><span class="field-value"><?php echo e($historial->cardiovasculares ?? 'No registra'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">Pulmonares</span><span class="field-value"><?php echo e($historial->pulmonales ?? 'No registra'); ?></span></td>
            <td><span class="field-label">Digestivos</span><span class="field-value"><?php echo e($historial->digestivos ?? 'No registra'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">Diabetes</span><span class="field-value"><?php echo e($historial->diabetes ?? 'No registra'); ?></span></td>
            <td><span class="field-label">Renales</span><span class="field-value"><?php echo e($historial->renales ?? 'No registra'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">Quirúrgicos</span><span class="field-value"><?php echo e($historial->quirurgicos ?? 'No registra'); ?></span></td>
            <td><span class="field-label">Transfusiones</span><span class="field-value"><?php echo e($historial->transfusiones ?? 'No registra'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">Alergias a medicamentos</span><span class="field-value"><?php echo e($historial->alergias_patologicas ?? 'No registra'); ?></span></td>
            <td><span class="field-label">Otros Patológicos</span><span class="field-value"><?php echo e($historial->otros_patologicos ?? 'No registra'); ?></span></td>
        </tr>
    </table>
</div>

<!-- ==================== ANTECEDENTES NO PATOLÓGICOS ==================== -->
<div class="section">
    <div class="section-title">[ANTECEDENTES PERSONALES NO PATOLÓGICOS]</div>
    <table class="grid-2">
        <tr>
            <td><span class="field-label">Alcohol</span><span class="field-value"><?php echo e($historial->alcohol ?? 'No registra'); ?></span></td>
            <td><span class="field-label">Tabaquismo</span><span class="field-value"><?php echo e($historial->tabaquismo ?? 'No registra'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">Drogas</span><span class="field-value"><?php echo e($historial->drogas ?? 'No registra'); ?></span></td>
            <td><span class="field-label">Inmunizaciones</span><span class="field-value"><?php echo e($historial->inmunizaciones ?? 'No registra'); ?></span></td>
        </tr>
        <tr>
            <td colspan="2"><span class="field-label">Otros No Patológicos</span><span class="field-value"><?php echo e($historial->otros_no_patologicos ?? 'No registra'); ?></span></td>
        </tr>
    </table>
</div>

<!-- ==================== ANTECEDENTES FAMILIARES ==================== -->
<div class="section">
    <div class="section-title">[ANTECEDENTES FAMILIARES]</div>
    <?php if($historial->familiares_no_refiere): ?>
        <p><span class="field-label">No refiere antecedentes familiares</span></p>
    <?php else: ?>
        <?php
            $familiares = [
                'familiar_hipertension' => 'Hipertensión Arterial',
                'familiar_diabetes' => 'Diabetes Mellitus',
                'familiar_cardiopatias' => 'Cardiopatías',
                'familiar_cancer' => 'Cáncer',
                'familiar_obesidad' => 'Obesidad',
                'familiar_dislipidemia' => 'Dislipidemia',
                'familiar_enfermedad_renal' => 'Enfermedad Renal',
                'familiar_enfermedad_tiroidea' => 'Enfermedad Tiroidea',
                'familiar_enfermedad_mental' => 'Enfermedad Mental',
                'familiar_tuberculosis' => 'Tuberculosis',
                'familiar_alcoholismo' => 'Alcoholismo',
                'familiar_otras' => 'Otras'
            ];
            $hayFamiliares = false;
        ?>
        <div style="margin-bottom: 8px;">
            <?php $__currentLoopData = $familiares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campo => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($historial->$campo): ?>
                    <?php $hayFamiliares = true; ?>
                    <span class="familiar-badge"><?php echo e($label); ?></span>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$hayFamiliares): ?>
                <span class="field-value">No refiere antecedentes familiares</span>
            <?php endif; ?>
        </div>
        <?php if($historial->antecedentes_familiares): ?>
            <table class="data-table">
                <tr><td><span class="field-label">Observaciones:</span> <?php echo e($historial->antecedentes_familiares); ?></td></tr>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</div>

<!-- ==================== GINECO OBSTÉTRICOS ==================== -->
<?php if($historial->paciente->genero == 'F'): ?>
<div class="section">
    <div class="section-title">[ANTECEDENTES GINECO OBSTÉTRICOS]</div>
    <table class="grid-3">
        <tr>
            <td><span class="field-label">Menarquia</span><span class="field-value"><?php echo e($historial->menarquia ?? 'No aplica'); ?></span></td>
            <td><span class="field-label">Ritmo Menstrual</span><span class="field-value"><?php echo e($historial->ritmo ?? 'No aplica'); ?></span></td>
            <td><span class="field-label">F.M.U</span><span class="field-value"><?php echo e($historial->fmu ? \Carbon\Carbon::parse($historial->fmu)->format('d/m/Y') : 'No registrada'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">G (Gestas)</span><span class="field-value"><?php echo e($historial->gestas ?? '0'); ?></span></td>
            <td><span class="field-label">P (Partos)</span><span class="field-value"><?php echo e($historial->partos ?? '0'); ?></span></td>
            <td><span class="field-label">A (Abortos)</span><span class="field-value"><?php echo e($historial->abortos ?? '0'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">C (Cesáreas)</span><span class="field-value"><?php echo e($historial->cesareas ?? '0'); ?></span></td>
            <td><span class="field-label">Hijos Vivos</span><span class="field-value"><?php echo e($historial->hijos_vivos ?? '0'); ?></span></td>
            <td><span class="field-label">N° Parejas Sexuales</span><span class="field-value"><?php echo e($historial->num_parejas_sexuales ?? 'No aplica'); ?></span></td>
        </tr>
        <tr>
            <td colspan="3"><span class="field-label">Menopausia</span><span class="field-value"><?php echo e($historial->menopausia ?? 'No aplica'); ?></span></td>
        </tr>
    </table>
    <hr>
    <table class="grid-2">
        <tr>
            <td><span class="field-label">Métodos Anticonceptivos</span><span class="field-value"><?php echo e($historial->usa_anticonceptivos ? 'Sí' : 'No'); ?></span></td>
            <td><span class="field-label">¿Cuáles?</span><span class="field-value"><?php echo e($historial->cuales_anticonceptivos ?? 'Ninguno'); ?></span></td>
        </tr>
    </table>
</div>
<?php endif; ?>

<!-- ==================== ENFERMEDAD ACTUAL ==================== -->
<div class="section">
    <div class="section-title">[ENFERMEDAD ACTUAL]</div>
    <table class="data-table">
        <tr><td><?php echo e($historial->enfermedad_actual ?? 'No registra'); ?></td></tr>
    </table>
</div>


<!-- ==================== SIGNOS VITALES ==================== -->
<div class="section">
    <div class="section-title">[SIGNOS VITALES]</div>
    <table class="grid-3">
        <tr>
            <td><span class="field-label">Presión Arterial</span><span class="field-value"><?php echo e($historial->presion_arterial ?? 'No registrada'); ?></span></td>
            <td><span class="field-label">FC (lpm)</span><span class="field-value"><?php echo e($historial->fc ?? 'No registrada'); ?></span></td>
            <td><span class="field-label">Sat O2 (%)</span><span class="field-value"><?php echo e($historial->sat ?? 'No registrada'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">FR (rpm)</span><span class="field-value"><?php echo e($historial->fr ?? 'No registrada'); ?></span></td>
            <td><span class="field-label">Temperatura (°C)</span><span class="field-value"><?php echo e($historial->temperatura ?? '36.5'); ?></span></td>
            <td><span class="field-label">IMC (kg/m²)</span><span class="field-value"><?php echo e($historial->imc ?? 'No calculado'); ?></span></td>
        </tr>
        <tr>
            <td><span class="field-label">Peso (kg)</span><span class="field-value"><?php echo e($historial->peso ?? 'No registrado'); ?></span></td>
            <td><span class="field-label">Talla (m)</span><span class="field-value"><?php echo e($historial->altura ?? 'No registrada'); ?></span></td>
            <td><span class="field-label">Masa Corporal</span><span class="field-value"><?php echo e($historial->masa_corporal ?? 'No calculado'); ?></span></td>
        </tr>
    </table>
</div>


<!-- ==================== EXPLORACIÓN FÍSICA ==================== -->
<div class="section">
    <div class="section-title">[EXPLORACIÓN FÍSICA]</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 25%; background: #ecf0f1;">Región</th>
                <th style="width: 10%; background: #ecf0f1; text-align: center;">CP/SP</th>
                <th style="width: 65%; background: #ecf0f1;">Hallazgos</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $exploraciones = [
                    'cabeza' => 'Cabeza',
                    'cuello' => 'Cuello',
                    'torax' => 'Tórax',
                    'abdomen' => 'Abdomen',
                    'extremidades' => 'Extremidades',
                    'neurologico' => 'Neurológico',
                    'piel' => 'Piel',
                    'columna' => 'Columna',
                    'pelvis' => 'Pelvis',
                    'axilas' => 'Axilas',
                    'mamas' => 'Mamas'
                ];
                $tieneHallazgos = false;
            ?>
            <?php $__currentLoopData = $exploraciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campo => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $valor = $historial->$campo;
                    $tipo = $historial->{$campo . '_tipo'} ?? 'SP';
                ?>
                <?php if($valor || $tipo == 'CP'): ?>
                    <?php $tieneHallazgos = true; ?>
                    <tr>
                        <td><?php echo e($label); ?></td>
                        <td style="text-align: center;">
                            <span class="badge <?php echo e($tipo == 'CP' ? 'badge-red' : 'badge-green'); ?>">
                                <?php echo e($tipo); ?>

                            </span>
                        </td>
                        <td><?php echo e($valor ?? 'Sin hallazgos'); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$tieneHallazgos): ?>
                <tr>
                    <td colspan="3" style="text-align: center; color: #999;">No hay registros de exploración física</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== REVISIÓN DE ÓRGANOS Y SISTEMAS ========== -->
<?php
    $sistemas = [
        ['id' => 'cardiovascular', 'icono' => '❤️', 'label' => 'Cardiovascular'],
        ['id' => 'respiratorio', 'icono' => '🫁', 'label' => 'Respiratorio'],
        ['id' => 'digestivo', 'icono' => '🍽️', 'label' => 'Digestivo'],
        ['id' => 'renal', 'icono' => '💧', 'label' => 'Renal'],
        ['id' => 'neurologico', 'icono' => '🧠', 'label' => 'Neurológico'],
        ['id' => 'musculoesqueletico', 'icono' => '🦴', 'label' => 'Musculoesquelético'],
        ['id' => 'endocrino', 'icono' => '🧬', 'label' => 'Endocrino'],
        ['id' => 'hematologico', 'icono' => '🩸', 'label' => 'Hematológico'],
        ['id' => 'linfatico', 'icono' => '🔬', 'label' => 'Linfático'],
        ['id' => 'genitourinario', 'icono' => '⚥', 'label' => 'Genitourinario'],
        ['id' => 'piel', 'icono' => '🧴', 'label' => 'Piel y Anexos'],
        ['id' => 'oftalmologico', 'icono' => '👁️', 'label' => 'Oftalmológico'],
        ['id' => 'orl', 'icono' => '👂', 'label' => 'Otorrinolaringológico'],
        ['id' => 'psiquiatrico', 'icono' => '🧠', 'label' => 'Psiquiátrico'],
    ];
    
    $tieneCP = false;
    foreach ($sistemas as $sistema) {
        $campo = 'sist_' . $sistema['id'];
        if (($historial->$campo ?? 'SP') == 'CP') {
            $tieneCP = true;
            break;
        }
    }
?>

<div class="seccion">
    <div class="titulo-seccion">REVISIÓN DE ÓRGANOS Y SISTEMAS</div>
    <div style="margin-bottom: 8px; font-size: 11px;">
        <span style="color: #28a745; font-weight: bold;">SP</span> = Sin evidencia patológica | 
        <span style="color: #dc3545; font-weight: bold;">CP</span> = Con evidencia patológica
    </div>
    <table style="width: 100%; border-collapse: collapse; font-size: 11px;">
        <thead>
            <tr style="background: #f0f4ff;">
                <th style="border: 1px solid #ddd; padding: 6px; text-align: left; width: 25%;">Sistema</th>
                <th style="border: 1px solid #ddd; padding: 6px; text-align: center; width: 10%;">SP/CP</th>
                <th style="border: 1px solid #ddd; padding: 6px; text-align: left; width: 65%;">Observación</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sistemas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sistema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $campo = 'sist_' . $sistema['id'];
                    $obsCampo = $campo . '_obs';
                    $valor = $historial->$campo ?? 'SP';
                    $observacion = $historial->$obsCampo ?? '';
                    $esCP = $valor == 'CP';
                ?>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 5px; font-weight: bold;">
                        <?php echo e($sistema['icono']); ?> <?php echo e($sistema['label']); ?>

                    </td>
                    <td style="border: 1px solid #ddd; padding: 5px; text-align: center; font-weight: bold; <?php echo e($esCP ? 'color: #dc3545;' : 'color: #28a745;'); ?>">
                        <?php echo e($valor); ?>

                    </td>
                    <td style="border: 1px solid #ddd; padding: 5px;">
                        <?php echo e($observacion ?: '-'); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    
    <?php if($historial->observaciones_sistemas): ?>
        <div style="margin-top: 10px; padding: 8px; background: #f8f9fa; border-radius: 4px; font-size: 11px;">
            <strong>Observaciones adicionales:</strong> <?php echo e($historial->observaciones_sistemas); ?>

        </div>
    <?php endif; ?>
</div>



<!-- ==================== DIAGNÓSTICOS ==================== -->
<div class="section">
    <div class="section-title">[DIAGNÓSTICOS]</div>
    <?php if($historial->diagnosticos->count() > 0): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5%; background: #ecf0f1; text-align: center;">#</th>
                    <th style="width: 45%; background: #ecf0f1;">Diagnóstico</th>
                    <th style="width: 30%; background: #ecf0f1;">Código CIE-10</th>
                    <th style="width: 20%; background: #ecf0f1; text-align: center;">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $historial->diagnosticos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $diag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center;"><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($diag->descripcion); ?></td>
                        <td><?php echo e($diag->cie10_code ?? 'No registrado'); ?></td>
                        <td style="text-align: center;">
                            <span class="badge <?php echo e($diag->tipo == 'PRE' ? 'badge-orange' : 'badge-blue'); ?>">
                                <?php echo e($diag->tipo == 'PRE' ? 'Presuntivo' : 'Definitivo'); ?>

                            </span>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay diagnósticos registrados</p>
    <?php endif; ?>
</div>

<!-- ==================== TRATAMIENTO Y RECOMENDACIONES ==================== -->
<div class="section">
    <div class="section-title">[TRATAMIENTO Y RECOMENDACIONES]</div>
    <table class="data-table">
        <tr>
            <td style="width: 20%;"><span class="field-label">Tratamiento</span></td>
            <td><?php echo e($historial->tratamiento ?? 'No registra'); ?></td>
        </tr>
        <tr>
            <td style="width: 20%;"><span class="field-label">Recomendaciones</span></td>
            <td><?php echo e($historial->recomendaciones ?? 'No registra'); ?></td>
        </tr>
    </table>
</div>

<!-- ==================== OBSERVACIONES ==================== -->
<?php if($historial->observaciones): ?>
<div class="section">
    <div class="section-title">[OBSERVACIONES]</div>
    <table class="data-table">
        <tr><td><?php echo e($historial->observaciones); ?></td></tr>
    </table>
</div>
<?php endif; ?>
<?php echo $__env->make('partials.pdf._firmas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!-- ==================== FIRMA ==================== -->
<div class="firma">
    <p>______________________</p>
    <br>
    <p><strong><?php echo e($historial->doctor ?? 'Médico Responsable'); ?></strong></p>
    <p style="font-size: 9px; color: #666;">Firma del Médico Responsable</p>
    <br>
    <p style="font-size: 8px; color: #999;">Documento generado electrónicamente - Sistema de Historial Clínico</p>
</div>

</body>
</html><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/reportes/historial-unico.blade.php ENDPATH**/ ?>