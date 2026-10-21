<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pedido de Exámenes</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 3px solid #1a5276; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { color: #1a5276; font-size: 20px; margin: 0; text-transform: uppercase; }
        .header p { margin: 2px 0; font-size: 10px; color: #666; }
        
        .info-box { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px; padding: 10px; margin-bottom: 15px; }
        .info-table { width: 100%; }
        .info-table td { padding: 3px 0; }
        .info-label { font-weight: bold; width: 120px; color: #555; }
        
        .section-title { background: #1a5276; color: white; padding: 5px 10px; font-size: 13px; font-weight: bold; margin-top: 15px; margin-bottom: 10px; }
        
        table.datos { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        table.datos th, table.datos td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        table.datos th { background: #e9ecef; font-size: 11px; }
        table.datos td { font-size: 11px; }
        
        .footer { margin-top: 50px; text-align: center; }
        .firma-line { border-top: 1px solid #333; width: 250px; margin: 0 auto 5px; }
        .firma-text { font-size: 11px; color: #333; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Pedido de Exámenes</h1>
        <p><strong>Punina Care</strong> - Sistema Clínico</p>
        <p>Fecha de Emisión: <?php echo e($pedido->fecha_pedido->format('d/m/Y')); ?></p>
    </div>

    <div class="info-box">
        <table class="info-table">
            <tr>
                <td class="info-label">Paciente:</td>
                <td><?php echo e($pedido->paciente->nombre_completo); ?></td>
                <td class="info-label">Cédula:</td>
                <td><?php echo e($pedido->paciente->cedula ?? 'No registrada'); ?></td>
            </tr>
            <tr>
                <td class="info-label">Edad:</td>
                <td><?php echo e($pedido->paciente->edad); ?> años</td>
                <td class="info-label">Médico:</td>
                <td>Dr. <?php echo e($pedido->medico->name); ?></td>
            </tr>
        </table>
    </div>

    <?php if($pedido->motivo || $pedido->resumen_clinico || $pedido->diagnostico_cie10): ?>
    <div class="section-title">Información Clínica</div>
    <table class="datos">
        <?php if($pedido->motivo): ?>
        <tr>
            <th width="20%">Motivo:</th>
            <td><?php echo e($pedido->motivo); ?></td>
        </tr>
        <?php endif; ?>
        <?php if($pedido->resumen_clinico): ?>
        <tr>
            <th>Resumen Clínico:</th>
            <td><?php echo e($pedido->resumen_clinico); ?></td>
        </tr>
        <?php endif; ?>
        <?php if($pedido->diagnostico_cie10): ?>
        <tr>
            <th>Diagnóstico (CIE-10):</th>
            <td><?php echo e($pedido->diagnostico_cie10); ?></td>
        </tr>
        <?php endif; ?>
    </table>
    <?php endif; ?>

    <div class="section-title">Exámenes Solicitados</div>
    <table class="datos">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Categoría</th>
                <th width="20%">Subcategoría</th>
                <th width="55%">Examen / Especificación</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pedido->detalles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $detalle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($index + 1); ?></td>
                <td><?php echo e($detalle->examen->categoria); ?></td>
                <td><?php echo e($detalle->examen->subcategoria); ?></td>
                <td>
                    <?php echo e($detalle->examen->nombre); ?>

                    <?php if($detalle->observaciones): ?>
                        <br><small><strong>Obs:</strong> <?php echo e($detalle->observaciones); ?></small>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="firma-line"></div>
        <div class="firma-text">Dr. <?php echo e($pedido->medico->name); ?></div>
        <div class="firma-text">Médico Solicitante</div>
    </div>

</body>
</html>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/pedidos-examenes/pdf.blade.php ENDPATH**/ ?>