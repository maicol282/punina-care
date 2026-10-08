<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receta Médica</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            background: #f5f7fa;
        }
        .receta {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 2px solid #1a5276;
            border-radius: 16px;
            padding: 30px 35px;
            position: relative;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        /* Logo de fondo */
        .receta::before {
            content: "⚕️";
            font-size: 200px;
            position: absolute;
            bottom: -20px;
            right: -10px;
            opacity: 0.04;
            transform: rotate(-5deg);
        }
        
        /* ===== HEADER ===== */
        .header {
            text-align: center;
            border-bottom: 3px solid #1a5276;
            padding-bottom: 15px;
            margin-bottom: 20px;
            position: relative;
        }
        .header .logo-icon {
            font-size: 32px;
            display: block;
            margin-bottom: 5px;
        }
        .header h1 {
            color: #1a5276;
            font-size: 24px;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-weight: 700;
            margin: 0;
        }
        .header .subtitle {
            color: #7f8c8d;
            font-size: 12px;
            letter-spacing: 2px;
            margin-top: 3px;
        }
        .header .linea-decorativa {
            width: 80px;
            height: 3px;
            background: #2980b9;
            margin: 8px auto 0;
            border-radius: 2px;
        }
        .header .fecha-emision {
            position: absolute;
            right: 0;
            top: 5px;
            font-size: 11px;
            color: #7f8c8d;
            background: #f0f4f8;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ===== INFO PACIENTE ===== */
        .info-paciente {
            background: linear-gradient(135deg, #f0f5f9 0%, #e8eef4 100%);
            padding: 15px 18px;
            margin-bottom: 20px;
            border-radius: 10px;
            border-left: 4px solid #2980b9;
        }
        .info-paciente .titulo-info {
            font-weight: 700;
            color: #1a5276;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 0;
            vertical-align: top;
            font-size: 11px;
        }
        .info-label {
            font-weight: 600;
            color: #2c3e50;
            display: inline-block;
            min-width: 90px;
        }
        .info-value {
            font-weight: 400;
            color: #1a1a1a;
        }
        .info-value .badge-cie10 {
            background: #1a5276;
            color: white;
            padding: 1px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
        }

        /* ===== TABLA DE RECETA (RP) ===== */
        .tabla-receta {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0 10px 0;
            border-radius: 8px;
            overflow: hidden;
        }
        .tabla-receta td {
            border: 1px solid #dce1e8;
            padding: 14px 16px;
            vertical-align: top;
        }
        .col-rp {
            width: 60px;
            background: #f0f5f9;
            text-align: center;
            font-weight: 700;
            font-size: 20px;
            color: #1a5276;
            letter-spacing: 1px;
        }
        .col-rp small {
            font-size: 9px;
            display: block;
            font-weight: 400;
            color: #7f8c8d;
        }
        .col-medicamento {
            width: 65%;
        }
        .col-indicaciones {
            width: 35%;
        }
        .detalle-row {
            padding: 3px 0;
            border-bottom: 1px dashed #e8edf3;
        }
        .detalle-row:last-child {
            border-bottom: none;
        }
        .detalle-label {
            font-weight: 600;
            color: #2c3e50;
            display: inline-block;
            min-width: 85px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .detalle-value {
            font-weight: 500;
            color: #1a1a1a;
        }
        .detalle-value .med-nombre {
            font-size: 13px;
            font-weight: 700;
            color: #1a5276;
        }
        .indicaciones-text {
            font-size: 11px;
            color: #2c3e50;
            line-height: 1.6;
        }
        .indicaciones-text .label-indicaciones {
            font-weight: 600;
            color: #1a5276;
            display: block;
            margin-bottom: 3px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        /* ===== MÚLTIPLES MEDICAMENTOS ===== */
        .medicamento-item {
            border-bottom: 1px dashed #e8edf3;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .medicamento-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .medicamento-item .med-numero {
            font-weight: 700;
            color: #7f8c8d;
            font-size: 10px;
            display: inline-block;
            min-width: 25px;
        }

        /* ===== SIGNOS Y RECOMENDACIONES ===== */
        .tabla-signos {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            border-radius: 8px;
            overflow: hidden;
        }
        .tabla-signos td {
            border: 1px solid #dce1e8;
            padding: 12px 16px;
            vertical-align: top;
            width: 50%;
        }
        .tabla-signos .col-signos {
            background: #fef9f0;
        }
        .tabla-signos .col-recomendaciones {
            background: #f0f8f5;
        }
        .titulo-seccion {
            font-weight: 700;
            color: #1a5276;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .titulo-seccion .icono {
            font-size: 14px;
        }
        .contenido-seccion {
            font-size: 10.5px;
            color: #2c3e50;
            line-height: 1.6;
        }
        .contenido-seccion .vacio {
            color: #b0b8c0;
            font-style: italic;
        }

        /* ===== ADVERTENCIAS ===== */
        .advertencias-box {
            margin: 10px 0 15px 0;
            padding: 12px 16px;
            border-radius: 8px;
            border: 1px solid #f5c6cb;
            background: #fef2f2;
        }
        .advertencias-box .adv-titulo {
            font-weight: 700;
            color: #c0392b;
            font-size: 11px;
            display: block;
            margin-bottom: 4px;
        }
        .advertencias-box .adv-contenido {
            font-size: 10.5px;
            color: #2c3e50;
        }

        /* ===== FIRMAS ===== */
        .tabla-nombres {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 10px 0;
        }
        .tabla-nombres td {
            border: 1px solid #dce1e8;
            padding: 18px 10px 12px 10px;
            vertical-align: middle;
            text-align: center;
            width: 50%;
        }
        .tabla-nombres .col-prescriptor {
            background: #f8faff;
        }
        .tabla-nombres .col-paciente {
            background: #fafff8;
        }
        .nombre-linea {
            border-top: 2px solid #2c3e50;
            width: 70%;
            margin: 25px auto 8px;
        }
        .nombre-texto {
            font-weight: 700;
            color: #1a5276;
            font-size: 13px;
        }
        .nombre-cargo {
            font-size: 10px;
            color: #7f8c8d;
            margin-top: 2px;
        }
        .nombre-sello {
            font-size: 9px;
            color: #b0b8c0;
            margin-top: 3px;
            font-style: italic;
        }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 20px;
            padding-top: 12px;
            border-top: 2px solid #e8edf3;
            font-size: 9px;
            color: #95a5a6;
            line-height: 1.6;
        }
        .footer .footer-leyenda {
            font-weight: 600;
            color: #c0392b;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        .footer .footer-texto {
            color: #7f8c8d;
        }
        .footer .footer-sistema {
            font-weight: 600;
            color: #1a5276;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 600px) {
            .receta { padding: 15px; }
            .tabla-receta td { display: block; width: 100%; }
            .col-rp { width: 100%; padding: 8px; }
            .tabla-signos td { display: block; width: 100%; }
            .tabla-nombres td { display: block; width: 100%; }
            .header .fecha-emision { position: static; text-align: center; margin-top: 5px; }
        }

        /* ===== UTILIDADES ===== */
        .text-center { text-align: center; }
        .text-muted { color: #7f8c8d; }
        .mt-1 { margin-top: 5px; }
        .mt-2 { margin-top: 10px; }
        .mb-1 { margin-bottom: 5px; }
        .mb-2 { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="receta">
        <!-- ===== HEADER ===== -->
        <div class="header">
            <span class="logo-icon">⚕️</span>
            <h1>Receta Médica</h1>
            <div class="subtitle">Prescripción Médica</div>
            <div class="linea-decorativa"></div>
            <div class="fecha-emision">
                 {{ $receta->fecha_emision->format('d/m/Y') }}
            </div>
        </div>
<!-- ===== INFORMACIÓN DEL PACIENTE ===== -->
<div class="info-paciente">
    <span class="titulo-info">📋 Datos del Paciente</span>
    <table class="info-table">
        <tr>
            <td width="45%">
                <span class="info-label"> Nombre:</span>
                <span class="info-value">{{ $receta->historialClinico->paciente->nombre_completo }}</span>
            </td>
            <td width="25%">
                <span class="info-label"> Cédula:</span>
                <span class="info-value">{{ $receta->historialClinico->paciente->cedula ?? 'No registrada' }}</span>
            </td>
            <td width="15%">
                <span class="info-label"> Edad:</span>
                <span class="info-value">{{ $receta->historialClinico->paciente->edad ?? 'N/E' }} años</span>
            </td>
            <td width="15%">
                <span class="info-label"> Sexo:</span>
                <span class="info-value">
                    @php
                        $genero = $receta->historialClinico->paciente->genero ?? '';
                        $generoTexto = match($genero) {
                            'M', 'Masculino' => 'Masculino',
                            'F', 'Femenino' => 'Femenino',
                            default => 'No especificado'
                        };
                    @endphp
                    {{ $generoTexto }}
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="info-label"> Diagnóstico:</span>
                <span class="info-value">
                    @php
                        $diagnostico = $receta->historialClinico->diagnosticos->first();
                    @endphp
                    @if($diagnostico)
                        <span class="badge-cie10">{{ $diagnostico->cie10_code ?? 'N/C' }}</span>
                        {{ $diagnostico->descripcion ?? 'No especificado' }}
                    @else
                        {{ $receta->historialClinico->diagnostico ?? 'No especificado' }}
                    @endif
                </span>
            </td>
            <td colspan="2">
                <span class="info-label"> Alergias:</span>
                <span class="info-value">{{ $receta->historialClinico->paciente->alergias ?? 'No reporta' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <span class="info-label"> Médico:</span>
                <span class="info-value">
                    @php
                        $doctor = $receta->historialClinico->doctor ?? '';
                        // Si el doctor está vacío o tiene caracteres extraños
                        if (empty($doctor) || $doctor === 'Dr. Médico' || str_contains($doctor, '?')) {
                            $doctor = 'Médico Responsable';
                        }
                    @endphp
                    {{ $doctor }}
                </span>
            </td>
        </tr>
    </table>
</div>
        <!-- ===== RECETA (RP) ===== -->
        @php
            $medicamentos = $receta->medicamentos_json ? json_decode($receta->medicamentos_json, true) : [];
        @endphp

        @if(count($medicamentos) > 0)
            <!-- Múltiples medicamentos -->
            <table class="tabla-receta">
                <tr>
                    <td class="col-rp">
                        Rp.
                        <small>receta</small>
                    </td>
                    <td class="col-medicamento">
                        @foreach($medicamentos as $index => $med)
                            <div class="medicamento-item">
                                <div class="detalle-row">
                                    <span class="detalle-label">Medicamento</span>
                                    <span class="detalle-value">
                                        <span class="med-numero">#{{ $index + 1 }}</span>
                                        <span class="med-nombre">{{ $med['medicamento'] ?? '' }}</span>
                                    </span>
                                </div>
                                @if(!empty($med['presentacion']))
                                <div class="detalle-row">
                                    <span class="detalle-label">Presentación</span>
                                    <span class="detalle-value">{{ $med['presentacion'] }}</span>
                                </div>
                                @endif
                                @if(!empty($med['concentracion']))
                                <div class="detalle-row">
                                    <span class="detalle-label">Concentración</span>
                                    <span class="detalle-value">{{ $med['concentracion'] }}</span>
                                </div>
                                @endif
                                @if(!empty($med['dosis']))
                                <div class="detalle-row">
                                    <span class="detalle-label">Dosis</span>
                                    <span class="detalle-value">{{ $med['dosis'] }}</span>
                                </div>
                                @endif
                                @if(!empty($med['frecuencia']))
                                <div class="detalle-row">
                                    <span class="detalle-label">Frecuencia</span>
                                    <span class="detalle-value">{{ $med['frecuencia'] }}</span>
                                </div>
                                @endif
                                @if(!empty($med['duracion']))
                                <div class="detalle-row">
                                    <span class="detalle-label">Duración</span>
                                    <span class="detalle-value">{{ $med['duracion'] }}</span>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </td>
                    <td class="col-indicaciones">
                        @php
                            $hasIndicaciones = false;
                            foreach ($medicamentos as $med) {
                                if (!empty($med['indicaciones'])) {
                                    $hasIndicaciones = true;
                                    break;
                                }
                            }
                        @endphp
                        @if($hasIndicaciones)
                            <div class="indicaciones-text">
                                <span class="label-indicaciones"> Indicaciones</span>
                                @foreach($medicamentos as $med)
                                    @if(!empty($med['indicaciones']))
                                        <div style="margin-bottom: 5px;">
                                            <strong>{{ $med['medicamento'] ?? 'Medicamento' }}:</strong>
                                            {{ $med['indicaciones'] }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="indicaciones-text">
                                <span class="label-indicaciones"> Indicaciones</span>
                                <span class="vacio">No se registraron indicaciones específicas</span>
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
        @else
            <!-- Receta con un solo medicamento (legacy) -->
            <table class="tabla-receta">
                <tr>
                    <td class="col-rp">
                        Rp.
                        <small>receta</small>
                    </td>
                    <td class="col-medicamento">
                        <div class="detalle-row">
                            <span class="detalle-label">Medicamento</span>
                            <span class="detalle-value">
                                <span class="med-nombre">{{ $receta->medicamento }}</span>
                                @if($receta->presentacion) ({{ $receta->presentacion }}) @endif
                            </span>
                        </div>
                        @if($receta->concentracion)
                        <div class="detalle-row">
                            <span class="detalle-label">Concentración</span>
                            <span class="detalle-value">{{ $receta->concentracion }}</span>
                        </div>
                        @endif
                        <div class="detalle-row">
                            <span class="detalle-label">Dosis</span>
                            <span class="detalle-value">{{ $receta->dosis }}</span>
                        </div>
                        <div class="detalle-row">
                            <span class="detalle-label">Frecuencia</span>
                            <span class="detalle-value">{{ $receta->frecuencia }}</span>
                        </div>
                        <div class="detalle-row">
                            <span class="detalle-label">Duración</span>
                            <span class="detalle-value">{{ $receta->duracion }}</span>
                        </div>
                    </td>
                    <td class="col-indicaciones">
                        <div class="indicaciones-text">
                            <span class="label-indicaciones"> Indicaciones</span>
                            @if($receta->indicaciones)
                                {{ $receta->indicaciones }}
                            @else
                                <span class="vacio">No se registraron indicaciones</span>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>
        @endif

        <!-- ===== ADVERTENCIAS ===== -->
        @if($receta->advertencias)
        <div class="advertencias-box">
            <span class="adv-titulo"> Advertencias</span>
            <span class="adv-contenido">{{ $receta->advertencias }}</span>
        </div>
        @endif

        <!-- ===== SIGNOS DE ALARMA | RECOMENDACIONES ===== -->
        <table class="tabla-signos">
            <tr>
                <td class="col-signos">
                    <div class="titulo-seccion">
                        <span class="icono"></span> Signos de Alarma
                    </div>
                    <div class="contenido-seccion">
                        @if($receta->signos_alarma)
                            {{ $receta->signos_alarma }}
                        @else
                            <span class="vacio">No se registraron signos de alarma</span>
                        @endif
                    </div>
                </td>
                <td class="col-recomendaciones">
                    <div class="titulo-seccion">
                        <span class="icono"></span> Recomendaciones no Farmacológicas
                    </div>
                    <div class="contenido-seccion">
                        @if($receta->recomendaciones_no_farmacologicas)
                            {{ $receta->recomendaciones_no_farmacologicas }}
                        @else
                            <span class="vacio">No se registraron recomendaciones</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>

        <!-- ===== FIRMA ===== -->
@if(isset($receta) && $receta->historialClinico->doctor)
    @php
        $doctor = $receta->historialClinico->doctor;
        $medicoUser = \App\Models\User::where('name', $doctor)->first();
    @endphp
    
    <div class="firma" style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #e8edf3; text-align: center;">
        @if($medicoUser && $medicoUser->firma_path)
            <div style="text-align: center; margin-bottom: 5px;">
                <img src="{{ public_path('storage/' . $medicoUser->firma_path) }}" 
                     alt="Firma" 
                     style="max-height: 60px; width: auto;">
            </div>
        @endif
        <div class="linea" style="border-top: 2px solid #1a1a1a; width: 50%; margin: 10px auto;"></div>
        <div class="nombre-texto" style="font-weight: 700; font-size: 14px;">{{ $doctor }}</div>
        <div class="nombre-cargo" style="font-size: 12px; color: #555;">Médico Tratante</div>
        <div style="font-size: 10px; color: #27ae60; margin-top: 5px;">
            ✅ Documento firmado electrónicamente
            <br>
            <span style="font-size: 9px; color: #888;">{{ now()->format('d/m/Y H:i') }}</span>
        </div>
    </div>
@endif
        <!-- ===== FOOTER ===== -->
        <div class="footer">
            <p>
                <span class="footer-leyenda"> ART.19.-</span>
                <span class="footer-texto">La vigencia máxima de las recetas médicas que contengan medicamentos antimicrobianos es de tres (03) días contados a partir de su prescripción.</span>
            </p>
            <p>
                <span class="footer-sistema">Sistema de Gestión Clínica</span>
                <span class="footer-texto">| Documento generado electrónicamente - Válido como prescripción médica</span>
            </p>
            <p class="footer-texto" style="font-size: 8px; color: #b0b8c0;">
                Conserve esta receta para futuras consultas | {{ now()->format('d/m/Y H:i') }}
            </p>
        </div>
    </div>
</body>
</html>