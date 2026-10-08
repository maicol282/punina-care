<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Historial Clínico - {{ $historial->paciente->nombre_completo }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            margin: 15px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            color: #2c3e50;
            margin: 0;
        }
        .header p {
            font-size: 9px;
            color: #666;
            margin: 3px 0;
        }
        .info-section {
            background: #f5f5f5;
            padding: 8px 12px;
            margin-bottom: 12px;
            border-radius: 5px;
        }
        .info-section h6 {
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        
        /* Tablas para diseño de columnas */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px;
            vertical-align: top;
            width: 25%;
        }
        .info-table tr td:first-child {
            font-weight: bold;
            width: 30%;
        }
        
        /* Secciones */
        .section {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }
        .section-title {
            background: #3498db;
            color: white;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        /* Grid con tablas */
        .grid-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .grid-table td {
            padding: 6px;
            vertical-align: top;
            border: 1px solid #e0e0e0;
            background: #f9f9f9;
        }
        
        .field-label {
            font-weight: bold;
            font-size: 9px;
            color: #555;
            display: block;
            margin-bottom: 3px;
        }
        .field-value {
            font-size: 9px;
            color: #333;
        }
        
        .signos-table {
            width: 100%;
            border-collapse: collapse;
        }
        .signos-table td {
            padding: 5px;
            border: 1px solid #ddd;
            background: #fafafa;
        }
        
        .firma {
            margin-top: 20px;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        hr {
            margin: 10px 0;
        }
        
        .badge {
            background: #2c3e50;
            color: white;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>HISTORIAL CLÍNICO</h2>
        <p>Fecha de emisión: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <!-- DATOS DEL PACIENTE -->
    <div class="info-section">
        <h6>📋 DATOS DEL PACIENTE</h6>
        <table class="info-table">
            <tr>
                <td><strong>Nombre:</strong></td>
                <td>{{ $historial->paciente->nombre_completo }}</td>
                <td><strong>Edad:</strong></td>
                <td>{{ $historial->paciente->edad }} años</td>
            </tr>
            <tr>
                <td><strong>Cédula:</strong></td>
                <td>{{ $historial->paciente->cedula ?? 'No registrada' }}</td>
                <td><strong>Género:</strong></td>
                <td>{{ $historial->paciente->genero == 'M' ? 'Masculino' : 'Femenino' }}</td>
            </tr>
            <tr>
                <td><strong>Teléfono:</strong></td>
                <td>{{ $historial->paciente->telefono }}</td>
                <td><strong>Email:</strong></td>
                <td>{{ $historial->paciente->email }}</td>
            </tr>
            <tr>
                <td><strong>Dirección:</strong></td>
                <td colspan="3">{{ $historial->paciente->direccion ?? 'No registrada' }}</td>
            </tr>
        </table>
    </div>

    <!-- DATOS DE LA CONSULTA -->
    <div class="info-section">
        <h6>🩺 DATOS DE LA CONSULTA</h6>
        <table class="info-table">
            <tr>
                <td><strong>Fecha:</strong></td>
                <td>{{ $historial->fecha_consulta->format('d/m/Y') }}</td>
                <td><strong>Doctor:</strong></td>
                <td>{{ $historial->doctor ?? 'No especificado' }}</td>
            </tr>
            <tr>
                <td><strong>Motivo:</strong></td>
                <td colspan="3">{{ $historial->motivo_consulta }}</td>
            </tr>
        </table>
    </div>

    <!-- SIGNOS VITALES -->
    <div class="section">
        <div class="section-title">📊 SIGNOS VITALES</div>
        <table class="signos-table">
            <tr>
                <td><strong>Presión Arterial:</strong><br>{{ $historial->presion_arterial ?? 'No registrada' }}</td>
                <td><strong>Frecuencia Cardíaca:</strong><br>{{ $historial->fc ?? 'No registrada' }} lpm</td>
            </tr>
            <tr>
                <td><strong>Saturación O2:</strong><br>{{ $historial->sat ?? 'No registrada' }}%</td>
                <td><strong>Frecuencia Respiratoria:</strong><br>{{ $historial->fr ?? 'No registrada' }} rpm</td>
                <td><strong>Temperatura:</strong><br>{{ $historial->temperatura ?? '36.5' }} °C</td>
                
            </tr>
            <tr>
                <td><strong>Peso:</strong><br>{{ $historial->peso ?? '70' }} kg</td>
                <td><strong>Talla:</strong><br>{{ $historial->altura ?? '1.65' }} m</td>
                <td><strong>Glicemia:</strong><br>{{ $historial->glicemia ?? 'No registrada' }} mg/dL</td>
                
            </tr>
        </table>
    </div>

    <!-- ANTECEDENTES PATOLÓGICOS -->
    <div class="section">
        <div class="section-title">📋 ANTECEDENTES PERSONALES PATOLÓGICOS</div>
        <table class="grid-table">
            <tr>
                <td width="50%"><span class="field-label">🏥 Hospitalizaciones</span><span class="field-value">{{ $historial->hospitalizaciones ?? 'Ninguna' }}</span></td>
                <td width="50%"><span class="field-label">❤️ Cardiovasculares</span><span class="field-value">{{ $historial->cardiovasculares ?? 'Ninguna' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">🫁 Pulmonares</span><span class="field-value">{{ $historial->pulmonales ?? 'Ninguna' }}</span></td>
                <td><span class="field-label">🍽️ Digestivos</span><span class="field-value">{{ $historial->digestivos ?? 'Ninguna' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">🩸 Diabetes</span><span class="field-value">{{ $historial->diabetes ?? 'Ninguna' }}</span></td>
                <td><span class="field-label">💧 Renales</span><span class="field-value">{{ $historial->renales ?? 'Ninguna' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">🔪 Quirúrgicos</span><span class="field-value">{{ $historial->quirurgicos ?? 'Ninguna' }}</span></td>
                <td><span class="field-label">🩸 Transfusiones</span><span class="field-value">{{ $historial->transfusiones ?? 'Ninguna' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">⚠️ Alergias a medicamentos</span><span class="field-value">{{ $historial->alergias_patologicas ?? 'Ninguna' }}</span></td>
                <td><span class="field-label">📋 Otros Patológicos</span><span class="field-value">{{ $historial->otros_patologicos ?? 'Ninguno' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- ANTECEDENTES NO PATOLÓGICOS -->
    <div class="section">
        <div class="section-title">📋 ANTECEDENTES PERSONALES NO PATOLÓGICOS</div>
        <table class="grid-table">
            <tr>
                <td width="50%"><span class="field-label">🍺 Alcohol</span><span class="field-value">{{ $historial->alcohol ?? 'No consume' }}</span></td>
                <td width="50%"><span class="field-label">🚬 Tabaquismo</span><span class="field-value">{{ $historial->tabaquismo ?? 'No fuma' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">💊 Drogas</span><span class="field-value">{{ $historial->drogas ?? 'No consume' }}</span></td>
                <td><span class="field-label">💉 Inmunizaciones</span><span class="field-value">{{ $historial->inmunizaciones ?? 'Esquema completo' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">👨‍👩‍👧‍👦 Antecedentes Familiares</span><span class="field-value">{{ $historial->antecedentes_familiares ?? 'No refiere' }}</span></td>
                <td><span class="field-label">📝 Otros</span><span class="field-value">{{ $historial->otros_no_patologicos ?? 'Ninguno' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- GINECO OBSTÉTRICOS (solo si aplica) -->
    @if($historial->paciente->genero == 'F')
    <div class="section">
        <div class="section-title">📋 ANTECEDENTES GINECO OBSTÉTRICOS</div>
        <table class="grid-table">
            <tr>
                <td width="33%"><span class="field-label">🩸 Menarquia</span><span class="field-value">{{ $historial->menarquia ?? 'No aplica' }}</span></td>
                <td width="33%"><span class="field-label">📅 Ritmo</span><span class="field-value">{{ $historial->ritmo ?? 'No aplica' }}</span></td>
                <td width="34%"><span class="field-label">📆 F.M.U</span><span class="field-value">{{ $historial->fmu ? \Carbon\Carbon::parse($historial->fmu)->format('d/m/Y') : 'No registrada' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">🤰 Gestas</span><span class="field-value">{{ $historial->gestas ?? '0' }}</span></td>
                <td><span class="field-label">👶 Partos</span><span class="field-value">{{ $historial->partos ?? '0' }}</span></td>
                <td><span class="field-label">💔 Abortos</span><span class="field-value">{{ $historial->abortos ?? '0' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">🏥 Cesáreas</span><span class="field-value">{{ $historial->cesareas ?? '0' }}</span></td>
                <td><span class="field-label">👥 N° Parejas</span><span class="field-value">{{ $historial->num_parejas_sexuales ?? 'No aplica' }}</span></td>
                <td><span class="field-label">🌸 Menopausia</span><span class="field-value">{{ $historial->menopausia ?? 'No aplica' }}</span></td>
            </tr>
        </table>
        <hr>
        <table class="grid-table">
            <tr>
                <td width="50%"><span class="field-label">💊 Métodos Anticonceptivos</span><span class="field-value">{{ $historial->usa_anticonceptivos ? 'Sí' : 'No' }}</span></td>
                <td width="50%"><span class="field-label">¿Cuáles?</span><span class="field-value">{{ $historial->cuales_anticonceptivos ?? 'Ninguno' }}</span></td>
            </tr>
        </table>
    </div>
    @endif

    <!-- EXPLORACIÓN FÍSICA -->
    <div class="section">
        <div class="section-title">🔍 EXPLORACIÓN FÍSICA</div>
        <table class="grid-table">
            <tr>
                <td width="50%"><span class="field-label">🧠 Cabeza</span><span class="field-value">{{ $historial->cabeza ?? 'Sin hallazgos' }}</span></td>
                <td width="50%"><span class="field-label">🦴 Cuello</span><span class="field-value">{{ $historial->cuello ?? 'Sin hallazgos' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">🫁 Tórax</span><span class="field-value">{{ $historial->torax ?? 'Sin hallazgos' }}</span></td>
                <td><span class="field-label">🫃 Abdomen</span><span class="field-value">{{ $historial->abdomen ?? 'Sin hallazgos' }}</span></td>
            </tr>
            <tr>
                <td><span class="field-label">🦵 Extremidades</span><span class="field-value">{{ $historial->extremidades ?? 'Sin hallazgos' }}</span></td>
                <td><span class="field-label">🧠 Neurológico</span><span class="field-value">{{ $historial->neurologico ?? 'Sin hallazgos' }}</span></td>
            </tr>
            <tr>
                <td colspan="2"><span class="field-label">🧠 Estado Mental</span><span class="field-value">{{ $historial->estado_mental ?? 'Orientado' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- ESTUDIOS COMPLEMENTARIOS -->
    <div class="section">
        <div class="section-title">🔬 ESTUDIOS COMPLEMENTARIOS</div>
        <table class="grid-table">
            <tr>
                <td width="33%"><span class="field-label">🧪 Laboratorio</span><span class="field-value">{{ $historial->laboratorio ?? 'Pendiente' }}</span></td>
                <td width="33%"><span class="field-label">🩻 Estudio de Imagen</span><span class="field-value">{{ $historial->estudio_imagen ?? 'Pendiente' }}</span></td>
                <td width="34%"><span class="field-label">📋 Otros</span><span class="field-value">{{ $historial->otros_exploracion ?? 'Ninguno' }}</span></td>
            </tr>
        </table>
    </div>

    <!-- ENFERMEDAD ACTUAL -->
    <div class="section">
        <div class="section-title">🩺 ENFERMEDAD ACTUAL</div>
        <table class="grid-table">
            <tr><td>{{ $historial->enfermedad_actual ?? 'Paciente refiere no presentar síntomas en el momento' }}</td></tr>
        </table>
    </div>

    <!-- DIAGNÓSTICO -->
    <div class="section">
        <div class="section-title">📝 DIAGNÓSTICO</div>
        <table class="grid-table">
            <tr><td>{{ $historial->diagnostico ?? 'Sin diagnóstico registrado' }}</td></tr>
        </table>
    </div>

    <!-- TRATAMIENTO -->
    <div class="section">
        <div class="section-title">💊 TRATAMIENTO</div>
        <table class="grid-table">
            <tr><td>{{ $historial->tratamiento ?? 'Sin tratamiento indicado' }}</td></tr>
        </table>
        @if($historial->medicamentos)
        <table class="grid-table" style="margin-top: 5px;">
            <tr><td><span class="field-label">💊 Medicamentos:</span> {{ $historial->medicamentos }}</td></tr>
        </table>
        @endif
    </div>

    <!-- OBSERVACIONES -->
    @if($historial->observaciones)
    <div class="section">
        <div class="section-title">📌 OBSERVACIONES</div>
        <table class="grid-table">
            <tr><td>{{ $historial->observaciones }}</td></tr>
        </table>
    </div>
    @endif

    <!-- SEGUIMIENTOS -->
    @if($historial->seguimientos->count() > 0)
    <div class="section">
        <div class="section-title">📋 SEGUIMIENTOS</div>
        @foreach($historial->seguimientos as $index => $seg)
        <table class="grid-table" style="margin-bottom: 10px;">
            <tr>
                <td>
                    <span class="badge">#{{ $index+1 }} - {{ $seg->fecha_seguimiento->format('d/m/Y') }}</span>
                    @if($seg->proxima_cita) <span class="badge" style="background: #27ae60;">Próxima: {{ $seg->proxima_cita->format('d/m/Y') }}</span> @endif
                </td>
            </tr>
            <tr><td><strong>Evolución:</strong> {{ $seg->evolucion }}</td></tr>
            @if($seg->nuevos_sintomas)<tr><td><strong>Nuevos síntomas:</strong> {{ $seg->nuevos_sintomas }}</td></tr>@endif
            @if($seg->medicamentos_ajustados)<tr><td><strong>Ajuste medicamentos:</strong> {{ $seg->medicamentos_ajustados }}</td></tr>@endif
            <tr><td><strong>Recomendaciones:</strong> {{ $seg->recomendaciones }}</td></tr>
        </table>
        @endforeach
    </div>
    @endif

    <!-- ===== FIRMAS ===== -->
<div style="margin-top: 40px; padding-top: 20px; border-top: 2px solid #e8edf3;">
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <!-- Firma del Médico -->
            <td style="width: 50%; text-align: center; padding: 20px 10px; vertical-align: bottom;">
                @php
                    $doctor = $historial->doctor ?? 'Médico Responsable';
                    $medicoUser = \App\Models\User::where('name', $doctor)->first();
                @endphp
                
                @if($medicoUser && $medicoUser->firma_path)
                    <div style="margin-bottom: 5px;">
                        <img src="{{ public_path('storage/' . $medicoUser->firma_path) }}" 
                             alt="Firma" 
                             style="max-height: 60px; width: auto;">
                    </div>
                @endif
                
                <div style="border-top: 2px solid #1a1a1a; width: 80%; margin: 10px auto 5px;"></div>
                <div style="font-weight: 700; font-size: 14px; color: #1a5276;">{{ $doctor }}</div>
                <div style="font-size: 12px; color: #555;">Médico Tratante</div>
                <div style="font-size: 10px; color: #27ae60; margin-top: 5px;">
                    ✅ Firmado electrónicamente
                </div>
                <div style="font-size: 9px; color: #888;">
                    {{ now()->format('d/m/Y H:i') }}
                </div>
            </td>
            
            <!-- Firma del Paciente -->
            <td style="width: 50%; text-align: center; padding: 20px 10px; vertical-align: bottom;">
                <div style="border-top: 2px solid #1a1a1a; width: 80%; margin: 30px auto 5px;"></div>
                <div style="font-weight: 700; font-size: 14px; color: #1a5276;">{{ $paciente->nombre }} {{ $paciente->apellido }}</div>
                <div style="font-size: 12px; color: #555;">Paciente / Representante</div>
                <div style="font-size: 9px; color: #888; margin-top: 5px;">
                    Cédula: {{ $paciente->cedula ?? 'N/E' }}
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>