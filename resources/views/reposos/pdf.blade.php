<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reposo Médico #{{ $reposo->numero_reposo }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif;
            padding: 40px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #1a5276;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1a5276;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header .subtitle {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        .numero {
            text-align: right;
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .numero strong {
            color: #1a5276;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }
        .info-grid .label {
            font-weight: bold;
            color: #1a5276;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-grid .value {
            font-size: 15px;
            margin-top: 3px;
        }
        .seccion {
            margin-bottom: 25px;
        }
        .seccion .titulo {
            font-weight: bold;
            color: #1a5276;
            font-size: 16px;
            border-bottom: 2px solid #1a5276;
            padding-bottom: 8px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .seccion .contenido {
            font-size: 15px;
            line-height: 1.8;
            padding: 5px 0;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .firma {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            padding-top: 30px;
        }
        .firma .firma-item {
            text-align: center;
            width: 45%;
        }
        .firma .firma-item .linea {
            border-top: 2px solid #333;
            width: 80%;
            margin: 30px auto 8px;
        }
        .firma .firma-item .label {
            font-size: 13px;
            color: #555;
        }
        .badge-estado {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }
        .badge-activo { background: #d4edda; color: #155724; }
        .badge-completado { background: #cce5ff; color: #004085; }
        .badge-anulado { background: #f8d7da; color: #721c24; }
        .info-extra {
            display: flex;
            gap: 30px;
            margin-bottom: 25px;
            background: #f8f9fa;
            padding: 15px 20px;
            border-radius: 8px;
        }
        .info-extra .item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-extra .item .etiqueta {
            font-weight: bold;
            color: #1a5276;
            font-size: 13px;
        }
        .info-extra .item .valor {
            font-size: 14px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            color: rgba(200, 200, 200, 0.12);
            font-weight: bold;
            letter-spacing: 10px;
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body>

    <!-- WATERMARK -->
    <div class="watermark">REPOSO</div>

    <!-- HEADER -->
    <div class="header">
        <h1>Reposo Médico</h1>
        <div class="subtitle">Certificado de Incapacidad</div>
    </div>

    <!-- NÚMERO -->
    <div class="numero">
        <strong>N°:</strong> {{ $reposo->numero_reposo }}
    </div>

    <!-- INFORMACIÓN PRINCIPAL -->
    <div class="info-grid">
        <div>
            <div class="label">Paciente</div>
            <div class="value">{{ $reposo->paciente->nombre }} {{ $reposo->paciente->apellido }}</div>
            
            <div class="label" style="margin-top: 12px;">Cédula</div>
            <div class="value">{{ $reposo->paciente->cedula ?? 'No especificada' }}</div>
            
            <div class="label" style="margin-top: 12px;">Teléfono</div>
            <div class="value">{{ $reposo->paciente->telefono ?? 'No especificado' }}</div>
        </div>
        <div>
            <div class="label">Fecha de Inicio</div>
            <div class="value">{{ $reposo->fecha_inicio->format('d/m/Y') }}</div>
            
            <div class="label" style="margin-top: 12px;">Fecha de Fin</div>
            <div class="value">{{ $reposo->fecha_fin->format('d/m/Y') }}</div>
            
            <div class="label" style="margin-top: 12px;">Días de Incapacidad</div>
            <div class="value"><strong>{{ $reposo->dias }}</strong> días</div>
        </div>
    </div>

    <!-- TIPO Y ESTADO -->
    <div class="info-extra">
        <div class="item">
            <span class="etiqueta">Tipo:</span>
            <span class="valor">{{ $reposo->tipo_label }}</span>
        </div>
        <div class="item">
            <span class="etiqueta">Estado:</span>
            <span class="badge-estado badge-{{ $reposo->estado }}">
                {{ $reposo->estado_label }}
            </span>
        </div>
        <div class="item">
            <span class="etiqueta">Médico:</span>
            <span class="valor">{{ $reposo->medico_emisor }}</span>
        </div>
    </div>

    <!-- DIAGNÓSTICO -->
    <div class="seccion">
        <div class="titulo">Diagnóstico</div>
        <div class="contenido">{{ $reposo->diagnostico }}</div>
    </div>

    <!-- RECOMENDACIONES -->
    @if($reposo->recomendaciones)
    <div class="seccion">
        <div class="titulo">Recomendaciones</div>
        <div class="contenido">{{ $reposo->recomendaciones }}</div>
    </div>
    @endif
<!-- ===== FIRMAS ===== -->
<div class="firma" style="margin-top: 40px; display: flex; justify-content: space-between; padding-top: 30px; border-top: 2px solid #e8edf3;">
    <!-- Firma del Médico -->
    <div class="firma-item" style="text-align: center; width: 45%;">
        @php
            $medicoUser = \App\Models\User::where('name', $reposo->medico_emisor)->first();
        @endphp
        
        @if($medicoUser && $medicoUser->firma_path)
            <div style="text-align: center; margin-bottom: 5px;">
                <img src="{{ public_path('storage/' . $medicoUser->firma_path) }}" 
                     alt="Firma" 
                     style="max-height: 50px; width: auto;">
            </div>
        @endif
        <div class="linea" style="border-top: 2px solid #1a1a1a; width: 80%; margin: 10px auto;"></div>
        <div class="nombre" style="font-weight: 700; font-size: 14px;">{{ $reposo->medico_emisor }}</div>
        <div class="cargo" style="font-size: 12px; color: #555;">Médico Emisor</div>
        <div style="font-size: 9px; color: #27ae60; margin-top: 3px;">
            ✅ Firmado electrónicamente
        </div>
    </div>
    
    <!-- Firma del Paciente -->
    <div class="firma-item" style="text-align: center; width: 45%;">
        <div class="linea" style="border-top: 2px solid #1a1a1a; width: 80%; margin: 30px auto 10px;"></div>
        <div class="nombre" style="font-weight: 700; font-size: 14px;">{{ $reposo->paciente->nombre }} {{ $reposo->paciente->apellido }}</div>
        <div class="cargo" style="font-size: 12px; color: #555;">Paciente / Representante</div>
    </div>
</div>

    <!-- PIE DE PÁGINA -->
    <div class="footer">
        <p>Documento emitido por el Sistema de Gestión Clínica</p>
        <p>Fecha de emisión: {{ now()->format('d/m/Y H:i') }}</p>
        <p style="font-size: 10px; color: #aaa; margin-top: 5px;">
            Este documento es de carácter informativo. Para cualquier trámite oficial, 
            presentar el documento físico con las firmas correspondientes.
        </p>
    </div>

</body>
</html>