<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Consultas del <?php echo e($fechaInicio->format('d/m/Y')); ?> al <?php echo e($fechaFin->format('d/m/Y')); ?></title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .resumen {
            background: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #3498db;
            color: white;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE CONSULTAS</h1>
        <p>Período: <?php echo e($fechaInicio->format('d/m/Y')); ?> al <?php echo e($fechaFin->format('d/m/Y')); ?></p>
        <p>Fecha de emisión: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
    </div>

    <div class="resumen">
        <strong>Resumen:</strong> Total de consultas en el período: <?php echo e($historiales->count()); ?>

    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Doctor</th>
                <th>Motivo</th>
                <th>Diagnóstico</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $historiales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $historial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($historial->fecha_consulta->format('d/m/Y')); ?></td>
                    <td><?php echo e($historial->paciente->nombre_completo); ?></td>
                    <td><?php echo e($historial->doctor ?? 'N/E'); ?></td>
                    <td><?php echo e(Str::limit($historial->motivo_consulta, 40)); ?></td>
                    <td><?php echo e(Str::limit($historial->diagnostico, 40)); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No hay consultas en el período seleccionado</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Documento generado electrónicamente - Sistema de Historial Clínico</p>
    </div>
</body>
</html><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/reportes/historiales-rango.blade.php ENDPATH**/ ?>