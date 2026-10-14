<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Estadísticas <?php echo e($mes); ?>/<?php echo e($anio); ?></title>
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
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 30px 0;
        }
        .stat-card {
            text-align: center;
            padding: 20px;
            background: #f5f5f5;
            border-radius: 10px;
            width: 30%;
        }
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            color: #3498db;
        }
        .stat-label {
            font-size: 14px;
            color: #666;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ESTADÍSTICAS MÉDICAS</h1>
        <p>Mes: <?php echo e($mes); ?>/<?php echo e($anio); ?></p>
        <p>Fecha de emisión: <?php echo e(now()->format('d/m/Y H:i')); ?></p>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-number"><?php echo e($totalPacientes); ?></div>
            <div class="stat-label">Nuevos Pacientes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo e($totalConsultas); ?></div>
            <div class="stat-label">Consultas Realizadas</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo e($totalSeguimientos); ?></div>
            <div class="stat-label">Seguimientos</div>
        </div>
    </div>

    <div class="footer">
        <p>Documento generado electrónicamente - Sistema de Historial Clínico</p>
        <p>* Este reporte es generado automáticamente por el sistema</p>
    </div>
</body>
</html><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/reportes/estadisticas-mensuales.blade.php ENDPATH**/ ?>