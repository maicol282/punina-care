@php
    $medico = auth()->user() ?? App\Models\User::where('name', $documento->doctor ?? '')->first();
    $tieneFirmaDigital = $medico && $medico->certificado_p12;
    $tieneFirmaManual = $medico && $medico->firma_path;
@endphp

<div style="margin-top: 40px; page-break-inside: avoid;">
    <table style="width: 100%; border: none;">
        <tr>
            <!-- Firma Manual del Médico -->
            <td style="width: 50%; text-align: center; vertical-align: bottom; padding: 10px;">
                @if($tieneFirmaManual)
                    <img src="{{ public_path('storage/' . $medico->firma_path) }}" alt="Firma Manual" style="max-height: 80px; max-width: 200px; margin-bottom: 10px;">
                @else
                    <div style="height: 80px;"></div> <!-- Espacio en blanco -->
                @endif
                <div style="border-top: 1px solid #333; width: 80%; margin: 0 auto;"></div>
                <div style="font-size: 10px; color: #555; margin-top: 5px;">
                    Dr(a). {{ $medico->name ?? 'Médico Tratante' }}<br>
                    {{ $medico->especialidad ?? 'Médico' }}
                </div>
            </td>

            <!-- Sello Digital FIRMA EC -->
            <td style="width: 50%; text-align: center; vertical-align: bottom; padding: 10px;">
                @if($tieneFirmaDigital)
                    <div style="border: 1.5px solid #28a745; border-radius: 8px; padding: 8px; background-color: #f4fcf6; display: inline-block; text-align: left;">
                        <div style="display: flex; align-items: center; margin-bottom: 4px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <strong style="color: #155724; font-size: 11px;">Firmado Electrónicamente</strong>
                        </div>
                        <div style="font-size: 9px; color: #155724; line-height: 1.3;">
                            <strong>Firmado por:</strong> {{ $medico->name }}<br>
                            <strong>Entidad:</strong> FIRMA EC (Ecuador)<br>
                            <strong>Fecha:</strong> {{ now()->format('d/m/Y H:i:s') }}<br>
                            <strong>Certificado:</strong> Válido
                        </div>
                    </div>
                @else
                    <div style="border: 1px dashed #ccc; padding: 15px; color: #999; font-size: 10px;">
                        Documento no firmado digitalmente
                    </div>
                @endif
            </td>
        </tr>
    </table>
</div>