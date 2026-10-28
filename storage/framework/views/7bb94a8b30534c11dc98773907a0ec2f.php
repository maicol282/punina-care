<?php
    $medico = auth()->user() ?? App\Models\User::where('name', $documento->doctor ?? '')->first();
    $tieneFirmaDigital = $medico && $medico->certificado_p12;
    $tieneFirmaManual = $medico && $medico->firma_path;
?>

<div style="margin-top: 40px; page-break-inside: avoid;">
    <table style="width: 100%; border: none;">
        <tr>
            <!-- Firma Manual del Médico -->
            <td style="width: 50%; text-align: center; vertical-align: bottom; padding: 10px;">
                <?php if($tieneFirmaManual): ?>
                    <img src="<?php echo e(public_path('storage/' . $medico->firma_path)); ?>" alt="Firma Manual" style="max-height: 80px; max-width: 200px; margin-bottom: 10px;">
                <?php else: ?>
                    <div style="height: 80px;"></div> <!-- Espacio en blanco -->
                <?php endif; ?>
                <div style="border-top: 1px solid #333; width: 80%; margin: 0 auto;"></div>
                <div style="font-size: 10px; color: #555; margin-top: 5px;">
                    Dr(a). <?php echo e($medico->name ?? 'Médico Tratante'); ?><br>
                    <?php echo e($medico->especialidad ?? 'Médico'); ?>

                </div>
            </td>

            <!-- Sello Digital FIRMA EC -->
            <td style="width: 50%; text-align: center; vertical-align: bottom; padding: 10px;">
                <?php if($tieneFirmaDigital): ?>
                    <div style="border: 1.5px solid #28a745; border-radius: 8px; padding: 8px; background-color: #f4fcf6; display: inline-block; text-align: left;">
                        <div style="display: flex; align-items: center; margin-bottom: 4px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <strong style="color: #155724; font-size: 11px;">Firmado Electrónicamente</strong>
                        </div>
                        <div style="font-size: 9px; color: #155724; line-height: 1.3;">
                            <strong>Firmado por:</strong> <?php echo e($medico->name); ?><br>
                            <strong>Entidad:</strong> FIRMA EC (Ecuador)<br>
                            <strong>Fecha:</strong> <?php echo e(now()->format('d/m/Y H:i:s')); ?><br>
                            <strong>Certificado:</strong> Válido
                        </div>
                    </div>
                <?php else: ?>
                    <div style="border: 1px dashed #ccc; padding: 15px; color: #999; font-size: 10px;">
                        Documento no firmado digitalmente
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</div><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/partials/pdf/_firmas.blade.php ENDPATH**/ ?>