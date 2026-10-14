<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Certificado Médico #<?php echo e($certificado->numero_certificado); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif;
            padding: 50px 60px;
            color: #1a1a1a;
            background: #fff;
            line-height: 1.7;
        }
        
        .certificado {
            max-width: 100%;
        }
        
        .fecha {
            text-align: right;
            font-size: 14px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        
        .titulo {
            text-align: center;
            font-size: 22px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 25px;
            color: #1a1a1a;
        }
        
        .contenido {
            font-size: 14px;
            line-height: 1.8;
        }
        
        .contenido .certifica {
            font-weight: 700;
            margin-top: 10px;
            display: block;
        }
        
        .contenido .paciente-datos {
            margin: 10px 0 10px 25px;
            padding-left: 5px;
        }
        
        .contenido .paciente-datos p {
            padding: 3px 0;
        }
        
        .contenido .paciente-datos .label {
            font-weight: 600;
        }
        
        .contenido .atendido {
            margin-top: 12px;
        }
        
        .diagnosticos {
            margin: 12px 0 12px 25px;
            padding-left: 5px;
        }
        
        .diagnosticos .diag-item {
            padding: 3px 0;
            font-weight: 500;
        }
        
        .contingencia {
            margin: 10px 0;
            font-weight: 600;
        }
        
        .contingencia .cont-value {
            font-weight: 700;
            text-transform: uppercase;
        }
        
        .reposo {
            margin: 15px 0;
            padding: 12px 18px;
            background: #f8f9fa;
            border-left: 4px solid #c0392b;
            border-radius: 4px;
        }
        
        .reposo .reposo-texto {
            font-weight: 600;
        }
        
        .reposo .reposo-dias {
            font-weight: 700;
            color: #c0392b;
        }
        
        .reposo .reposo-fechas {
            margin-top: 5px;
        }
        
        .reposo .reposo-fechas .fecha-label {
            font-weight: 600;
        }
        
        .firma {
            margin-top: 50px;
            padding-top: 30px;
            text-align: center;
            border-top: 2px solid #e8edf3;
        }
        
        .firma .linea {
            border-top: 2px solid #1a1a1a;
            width: 50%;
            margin: 30px auto 10px;
        }
        
        .firma .nombre {
            font-weight: 700;
            font-size: 16px;
            text-transform: uppercase;
            color: #1a1a1a;
        }
        
        .firma .cargo {
            font-size: 14px;
            color: #555;
            margin-top: 2px;
        }
        
        .firma .cedula {
            font-size: 13px;
            color: #666;
            margin-top: 2px;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #e8edf3;
            text-align: center;
            color: #888;
            font-size: 11px;
            line-height: 1.6;
        }
        
        .footer .sistema {
            font-weight: 600;
            color: #1a5276;
        }
        
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(26, 82, 118, 0.04);
            font-weight: 700;
            letter-spacing: 15px;
            pointer-events: none;
            z-index: -1;
            text-transform: uppercase;
        }
        
        .text-muted { color: #888; }
    </style>
</head>
<body>

    <div class="watermark">CERTIFICADO</div>

    <div class="certificado">

        <div class="fecha">
            <strong>Guaranda, <?php echo e($certificado->fecha_atencion->format('d')); ?> de 
            <?php echo e(['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'][$certificado->fecha_atencion->format('n') - 1]); ?> del 
            <?php echo e($certificado->fecha_atencion->format('Y')); ?></strong>
        </div>

        <div class="titulo">CERTIFICADO MÉDICO</div>

        <div class="contenido">

            <span class="certifica">Certifica que el paciente:</span>

            <div class="paciente-datos">
                <p><span class="label">• Apellidos y nombres completos del afiliado/paciente:</span> 
                    <strong><?php echo e($certificado->paciente_nombre); ?></strong></p>
                <p><span class="label">• Dirección domiciliaria:</span> 
                    <?php echo e($certificado->paciente_direccion ?? 'No especificada'); ?></p>
                <p><span class="label">• Número telefónico de contacto:</span> 
                    <?php echo e($certificado->paciente_telefono ?? 'No especificado'); ?></p>
                <p><span class="label">• Institución/empresa donde trabaja:</span> 
                    <?php echo e($certificado->paciente_empresa ?? 'No especificada'); ?></p>
                <p><span class="label">• Puesto de trabajo del paciente:</span> 
                    <?php echo e($certificado->paciente_puesto ?? 'No especificado'); ?></p>
                <p><span class="label">• Número de cédula de identidad del paciente:</span> 
                    <strong><?php echo e($certificado->paciente_cedula); ?></strong></p>
                <p><span class="label">• Número de historia clínica del paciente:</span> 
                    <strong>#<?php echo e($certificado->historialClinico->id); ?></strong></p>
            </div>

            <p class="atendido">
                Ha sido atendido en el consultorio médico <strong>PUNINACARE</strong> 
                el día <strong><?php echo e($certificado->fecha_atencion->format('d/m/Y')); ?></strong>, 
                por los siguientes diagnósticos:
            </p>

            <div class="diagnosticos">
                <?php
                    $diagnosticos = explode("\n", trim($certificado->diagnosticos));
                ?>
                <?php $__currentLoopData = $diagnosticos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diagnostico): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(trim($diagnostico)): ?>
                        <p class="diag-item"><strong>- <?php echo e(trim($diagnostico)); ?></strong></p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="contingencia">
                <strong>TIPO DE CONTINGENCIA:</strong> 
                <span class="cont-value"><?php echo e($certificado->tipo_contingencia_label); ?></span>
            </div>

            <?php if($certificado->reposo): ?>
            <div class="reposo">
                <p class="reposo-texto">
                    Por lo que se indica reposo médico por 
                    <span class="reposo-dias"><?php echo e($certificado->reposo_dias); ?> días</span>.
                </p>
                <div class="reposo-fechas">
                    <p>
                        <span class="fecha-label">Fecha de inicio de reposo desde:</span> 
                        el <strong><?php echo e($certificado->reposo_inicio->format('d/m/Y')); ?></strong>
                        (<?php echo e($certificado->reposo_inicio->format('d')); ?> de 
                        <?php echo e(['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'][$certificado->reposo_inicio->format('n') - 1]); ?> del 
                        <?php echo e($certificado->reposo_inicio->format('Y')); ?>)
                    </p>
                    <p>
                        <span class="fecha-label">Fecha de fin de reposo hasta:</span> 
                        el <strong><?php echo e($certificado->reposo_fin->format('d/m/Y')); ?></strong>
                        (<?php echo e($certificado->reposo_fin->format('d')); ?> de 
                        <?php echo e(['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'][$certificado->reposo_fin->format('n') - 1]); ?> del 
                        <?php echo e($certificado->reposo_fin->format('Y')); ?>)
                    </p>
                </div>
            </div>
            <?php endif; ?>

            <p style="margin-top: 20px;">
                Es todo en cuanto puedo decir en honor a la verdad.
            </p>
            <p style="margin-top: 5px;">
                La persona interesada puede hacer uso de la presente certificación en lo que bien le convenga, bajo su responsabilidad.
            </p>
        </div>

        <!-- ===== FIRMA ===== -->
<div class="firma">
    <?php
        $medicoUser = \App\Models\User::where('name', $certificado->medico_nombre)->first();
    ?>
    
    <?php if($medicoUser && $medicoUser->firma_path): ?>
        <div style="text-align: center; margin-bottom: 5px;">
            <img src="<?php echo e(public_path('storage/' . $medicoUser->firma_path)); ?>" 
                 alt="Firma" 
                 style="max-height: 60px; width: auto;">
        </div>
    <?php endif; ?>
    
    <div class="linea"></div>
    <div class="nombre"><?php echo e($certificado->medico_nombre); ?></div>
    <div class="cargo"><?php echo e($certificado->medico_especialidad ?? 'Medicina General'); ?></div>
    <div class="cedula">CI: <?php echo e($certificado->medico_cedula ?? 'N/E'); ?></div>
    <div style="font-size: 11px; color: #27ae60; margin-top: 5px;">
        ✅ Documento firmado electrónicamente
        <br>
        <span style="font-size: 9px; color: #888;"><?php echo e(now()->format('d/m/Y H:i')); ?></span>
    </div>
</div>

        <div class="footer">
            <p>
                <span>Punina Care, RUC:1726064502001 infopuninacare@gmail.com, Telefono:0969469299, CheGuevara y Arregui, Barrio La Primavera, Consultorios médicos.</span>
                <span class="sistema">Sistema de Gestión Clínica</span>
                <span class="text-muted">| Documento generado electrónicamente</span>
            </p>
            <p class="text-muted" style="font-size: 10px;">
                Certificado N°: <?php echo e($certificado->numero_certificado); ?> | 
                <?php echo e(now()->format('d/m/Y H:i')); ?>

            </p>
        </div>

    </div>
</body>
</html><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/certificados/pdf.blade.php ENDPATH**/ ?>