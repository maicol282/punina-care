<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recetario - <?php echo e($historial->paciente->nombre_completo); ?></title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .info-paciente {
            background: #f0f0f0;
            padding: 10px;
            margin-bottom: 20px;
        }
        .receta-item {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            page-break-inside: avoid;
        }
        .page-break {
            page-break-before: always;
        }
        table {
            width: 100%;
        }
        td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>RECETARIO MÉDICO</h1>
        <p>Sistema de Gestión Médica</p>
        <p>Fecha de emisión: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
    </div>

    <div class="info-paciente">
        <table>
            <tr>
                <td width="50%"><strong>Paciente:</strong> <?php echo e($historial->paciente->nombre_completo); ?></td>
                <td width="50%"><strong>Edad:</strong> <?php echo e($historial->paciente->edad); ?> años</td>
            </tr>
            <tr>
                <td><strong>Cédula:</strong> <?php echo e($historial->paciente->cedula ?? 'No registrada'); ?></td>
                <td><strong>Teléfono:</strong> <?php echo e($historial->paciente->telefono); ?></td>
            </tr>
            <tr>
                <td><strong>Doctor:</strong> <?php echo e($historial->doctor ?? 'No especificado'); ?></td>
                <td><strong>Fecha Consulta:</strong> <?php echo e($historial->fecha_consulta->format('d/m/Y')); ?></td>
            </tr>
        </table>
    </div>

    <h3>Recetas Prescritas (<?php echo e($recetas->count()); ?>)</h3>

    <?php $__currentLoopData = $recetas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $receta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="receta-item">
            <h4>Receta #<?php echo e($index + 1); ?> - <?php echo e($receta->fecha_emision->format('d/m/Y')); ?></h4>
            <table>
                <tr>
                    <td width="30%"><strong>Medicamento:</strong></td>
                    <td><?php echo e($receta->medicamento); ?></td>
                </tr>
                <?php if($receta->presentacion): ?>
                <tr>
                    <td><strong>Presentación:</strong></td>
                    <td><?php echo e($receta->presentacion); ?></td>
                </tr>
                <?php endif; ?>
                <?php if($receta->concentracion): ?>
                <tr>
                    <td><strong>Concentración:</strong></td>
                    <td><?php echo e($receta->concentracion); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td><strong>Dosis:</strong></td>
                    <td><?php echo e($receta->dosis); ?></td>
                </tr>
                <tr>
                    <td><strong>Frecuencia:</strong></td>
                    <td><?php echo e($receta->frecuencia); ?></td>
                </tr>
                <tr>
                    <td><strong>Duración:</strong></td>
                    <td><?php echo e($receta->duracion); ?></td>
                </tr>
            </table>
            
            <?php if($receta->indicaciones): ?>
                <p><strong>Indicaciones:</strong> <?php echo e($receta->indicaciones); ?></p>
            <?php endif; ?>
            
            <?php if($receta->advertencias): ?>
                <p><strong>Advertencias:</strong> <?php echo e($receta->advertencias); ?></p>
            <?php endif; ?>
            
            <div style="margin-top: 15px;">
                <p>___________________________________</p>
                <p>Firma del Médico</p>
            </div>
        </div>
        <?php if(!$loop->last): ?>
            <div class="page-break"></div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/recetas/pdf-todas.blade.php ENDPATH**/ ?>