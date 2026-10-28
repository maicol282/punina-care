<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recetario - {{ $historial->paciente->nombre_completo }}</title>
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
        <p>Fecha de emisión: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info-paciente">
        <table>
            <tr>
                <td width="50%"><strong>Paciente:</strong> {{ $historial->paciente->nombre_completo }}</td>
                <td width="50%"><strong>Edad:</strong> {{ $historial->paciente->edad }} años</td>
            </tr>
            <tr>
                <td><strong>Cédula:</strong> {{ $historial->paciente->cedula ?? 'No registrada' }}</td>
                <td><strong>Teléfono:</strong> {{ $historial->paciente->telefono }}</td>
            </tr>
            <tr>
                <td><strong>Doctor:</strong> {{ $historial->doctor ?? 'No especificado' }}</td>
                <td><strong>Fecha Consulta:</strong> {{ $historial->fecha_consulta->format('d/m/Y') }}</td>
            </tr>
        </table>
    </div>

    <h3>Recetas Prescritas ({{ $recetas->count() }})</h3>

    @foreach($recetas as $index => $receta)
        <div class="receta-item">
            <h4>Receta #{{ $index + 1 }} - {{ $receta->fecha_emision->format('d/m/Y') }}</h4>
                        @php
                $meds = $receta->medicamentos_json ? json_decode($receta->medicamentos_json, true) : [];
                if (empty($meds)) {
                    $meds = [['medicamento' => $receta->medicamento, 'dosis' => $receta->dosis, 'frecuencia' => $receta->frecuencia, 'duracion' => $receta->duracion]];
                }
            @endphp

            @foreach($meds as $i => $med)
                <table style="margin-bottom: 10px; border-bottom: 1px dashed #ccc;">
                    <tr>
                        <td width="30%"><strong>Medicamento #{{ $i + 1 }}:</strong></td>
                        <td>{{ $med['medicamento'] ?? '' }}</td>
                    </tr>
                    @if(!empty($med['presentacion']))
                    <tr>
                        <td><strong>Presentación:</strong></td>
                        <td>{{ $med['presentacion'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($med['concentracion']))
                    <tr>
                        <td><strong>Concentración:</strong></td>
                        <td>{{ $med['concentracion'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($med['via']))
                    <tr>
                        <td><strong>Vía:</strong></td>
                        <td>{{ $med['via'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($med['dosis']))
                    <tr>
                        <td><strong>Dosis:</strong></td>
                        <td>{{ $med['dosis'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($med['frecuencia']))
                    <tr>
                        <td><strong>Frecuencia:</strong></td>
                        <td>{{ $med['frecuencia'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($med['duracion']))
                    <tr>
                        <td><strong>Duración:</strong></td>
                        <td>{{ $med['duracion'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($med['cantidad']))
                    <tr>
                        <td><strong>Cantidad:</strong></td>
                        <td>{{ $med['cantidad'] }}</td>
                    </tr>
                    @endif
                    @if(!empty($med['advertencias']))
                    <tr>
                        <td><strong>Advertencias:</strong></td>
                        <td style="color: #c0392b;">{{ $med['advertencias'] }}</td>
                    </tr>
                    @endif
                </table>
            @endforeach
            
            @if($receta->indicaciones)
                <p><strong>Indicaciones:</strong> {{ $receta->indicaciones }}</p>
            @endif
            
            @if($receta->advertencias)
                <p><strong>Advertencias:</strong> {{ $receta->advertencias }}</p>
            @endif
            
            <div style="margin-top: 15px;">
                @include('partials.pdf._firmas')
                <p>___________________________________</p>
                <p>Firma del Médico</p>
            </div>
        </div>
        @if(!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
    
</body>
</html>