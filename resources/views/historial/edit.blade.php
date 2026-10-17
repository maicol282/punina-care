@extends('layouts.app')

@section('title', 'Editar Historial Clínico')
@section('page-title', 'Editar Historial Clínico')

@section('content')
<div class="container-fluid px-0">
    <!-- Información del paciente -->
       @include('historial.partials.edit._info-paciente')
    

    <form action="{{ route('historial.update', $historial->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ========== DATOS DE LA CONSULTA ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-notes-medical me-2 text-primary"></i> Datos de la Consulta
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Fecha Consulta <span class="text-danger">*</span></label>
                        <input type="date" name="fecha_consulta" class="form-control" value="{{ old('fecha_consulta', $historial->fecha_consulta->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Doctor Responsable</label>
                        <select name="doctor" class="form-select">
                            <option value="">Seleccione un médico</option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->name }}" {{ old('doctor', $historial->doctor) == $medico->name ? 'selected' : '' }}>
                                    {{ $medico->name }} @if($medico->especialidad) - {{ $medico->especialidad }} @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Motivo de Consulta <span class="text-danger">*</span></label>
                        <textarea name="motivo_consulta" class="form-control" rows="2" placeholder="Describa el motivo..." required>{{ old('motivo_consulta', $historial->motivo_consulta) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-notes-medical me-2 text-primary"></i> Antecedentes Personales Patológicos
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🏥 Hospitalizaciones</label>
                        <textarea name="hospitalizaciones" class="form-control" rows="2" placeholder="Describa hospitalizaciones previas...">{{ old('hospitalizaciones', $historial->hospitalizaciones) }}</textarea>
                    </div>

                    @php $hasCV = old('cardiovasculares', $historial->cardiovasculares); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_cardiovasculares" data-target="cardiovasculares" {{ $hasCV ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_cardiovasculares">❤️ Cardiovasculares</label>
                                </div>
                                <textarea name="cardiovasculares" id="cardiovasculares" class="form-control mt-2 campo-patologico" style="display: {{ $hasCV ? 'block' : 'none' }};" rows="2" placeholder="Hipertensión, arritmias...">{{ old('cardiovasculares', $historial->cardiovasculares) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasPul = old('pulmonales', $historial->pulmonales); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_pulmonales" data-target="pulmonales" {{ $hasPul ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_pulmonales">🫁 Pulmonares</label>
                                </div>
                                <textarea name="pulmonales" id="pulmonales" class="form-control mt-2 campo-patologico" style="display: {{ $hasPul ? 'block' : 'none' }};" rows="2" placeholder="Asma, EPOC, bronquitis...">{{ old('pulmonales', $historial->pulmonales) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasDig = old('digestivos', $historial->digestivos); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_digestivos" data-target="digestivos" {{ $hasDig ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_digestivos">🍽️ Digestivos</label>
                                </div>
                                <textarea name="digestivos" id="digestivos" class="form-control mt-2 campo-patologico" style="display: {{ $hasDig ? 'block' : 'none' }};" rows="2" placeholder="Gastritis, colitis...">{{ old('digestivos', $historial->digestivos) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasDia = old('diabetes', $historial->diabetes); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_diabetes" data-target="diabetes" {{ $hasDia ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_diabetes">🩸 Diabetes</label>
                                </div>
                                <textarea name="diabetes" id="diabetes" class="form-control mt-2 campo-patologico" style="display: {{ $hasDia ? 'block' : 'none' }};" rows="2" placeholder="Tipo, tiempo...">{{ old('diabetes', $historial->diabetes) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasRen = old('renales', $historial->renales); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_renales" data-target="renales" {{ $hasRen ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_renales">💧 Renales</label>
                                </div>
                                <textarea name="renales" id="renales" class="form-control mt-2 campo-patologico" style="display: {{ $hasRen ? 'block' : 'none' }};" rows="2" placeholder="Insuficiencia renal...">{{ old('renales', $historial->renales) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🔪 Quirúrgicos</label>
                        <textarea name="quirurgicos" class="form-control" rows="2" placeholder="Cirugías previas...">{{ old('quirurgicos', $historial->quirurgicos) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🩸 Transfusiones</label>
                        <textarea name="transfusiones" class="form-control" rows="2" placeholder="Número, fechas...">{{ old('transfusiones', $historial->transfusiones) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">⚠️ Alergias a medicamentos</label>
                        <textarea name="alergias_patologicas" class="form-control" rows="2" placeholder="Penicilina, Ibuprofeno...">{{ old('alergias_patologicas', $historial->alergias_patologicas) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">📋 Otros Patológicos</label>
                        <textarea name="otros_patologicos" class="form-control" rows="2" placeholder="Otras condiciones...">{{ old('otros_patologicos', $historial->otros_patologicos) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== ANTECEDENTES PERSONALES NO PATOLÓGICOS ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-heartbeat me-2 text-primary"></i> Antecedentes Personales No Patológicos
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🍺 Alcohol</label>
                        <textarea name="alcohol" class="form-control" rows="2" placeholder="Frecuencia, cantidad...">{{ old('alcohol', $historial->alcohol) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🚬 Tabaquismo</label>
                        <textarea name="tabaquismo" class="form-control" rows="2" placeholder="Cigarrillos/día...">{{ old('tabaquismo', $historial->tabaquismo) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">💊 Drogas</label>
                        <textarea name="drogas" class="form-control" rows="2" placeholder="Tipo, frecuencia...">{{ old('drogas', $historial->drogas) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">💉 Inmunizaciones</label>
                        <textarea name="inmunizaciones" class="form-control" rows="2" placeholder="Vacunas, fechas...">{{ old('inmunizaciones', $historial->inmunizaciones) }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">📝 Otros No Patológicos</label>
                        <textarea name="otros_no_patologicos" class="form-control" rows="2" placeholder="Ejercicio, alimentación...">{{ old('otros_no_patologicos', $historial->otros_no_patologicos) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== ANTECEDENTES FAMILIARES ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-users me-2 text-primary"></i> Antecedentes Familiares
            </div>
            <div class="card-body">
                <p class="text-muted small mb-3">Marque las enfermedades que tiene algún familiar directo (padres, hermanos, hijos)</p>
                <div class="row g-3">
                    @php
                        $familiares = [
                            'familiar_hipertension' => 'Hipertensión Arterial',
                            'familiar_diabetes' => 'Diabetes Mellitus',
                            'familiar_cardiopatias' => 'Cardiopatías',
                            'familiar_cancer' => 'Cáncer',
                            'familiar_obesidad' => 'Obesidad',
                            'familiar_dislipidemia' => 'Dislipidemia',
                            'familiar_enfermedad_renal' => 'Enfermedad Renal',
                            'familiar_enfermedad_tiroidea' => 'Enfermedad Tiroidea',
                            'familiar_enfermedad_mental' => 'Enfermedad Mental',
                            'familiar_tuberculosis' => 'Tuberculosis',
                            'familiar_alcoholismo' => 'Alcoholismo',
                            'familiar_otras' => 'Otras'
                        ];
                    @endphp
                    
                    @foreach($familiares as $key => $label)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input familiar-checkbox" type="checkbox" name="{{ $key }}" id="{{ $key }}" value="1" {{ old($key, $historial->$key) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="col-md-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="familiares_no_refiere" id="familiares_no_refiere" value="1" {{ old('familiares_no_refiere', $historial->familiares_no_refiere) ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="familiares_no_refiere">No refiere antecedentes familiares</label>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Observaciones de Antecedentes Familiares</label>
                        <textarea name="antecedentes_familiares" class="form-control" rows="2" placeholder="Detalle adicional de antecedentes familiares...">{{ old('antecedentes_familiares', $historial->antecedentes_familiares) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== GINECO OBSTÉTRICOS ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-female me-2 text-primary"></i> Antecedentes Gineco Obstétricos
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Menarquia</label>
                        <input type="text" name="menarquia" class="form-control" placeholder="Edad" value="{{ old('menarquia', $historial->menarquia) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Ritmo Menstrual</label>
                        <input type="text" name="ritmo" class="form-control" placeholder="Regular/Irregular" value="{{ old('ritmo', $historial->ritmo) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">F.M.U</label>
                        <input type="date" name="fmu" class="form-control" value="{{ old('fmu', $historial->fmu ? $historial->fmu->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Menopausia</label>
                        <select name="menopausia" class="form-select">
                            <option value="">Seleccione</option>
                            <option value="Premenopausia" {{ old('menopausia', $historial->menopausia) == 'Premenopausia' ? 'selected' : '' }}>Premenopausia</option>
                            <option value="Perimenopausia" {{ old('menopausia', $historial->menopausia) == 'Perimenopausia' ? 'selected' : '' }}>Perimenopausia</option>
                            <option value="Menopausia" {{ old('menopausia', $historial->menopausia) == 'Menopausia' ? 'selected' : '' }}>Menopausia</option>
                            <option value="Postmenopausia" {{ old('menopausia', $historial->menopausia) == 'Postmenopausia' ? 'selected' : '' }}>Postmenopausia</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">G (Gestas)</label>
                        <input type="number" name="gestas" class="form-control" placeholder="0" min="0" value="{{ old('gestas', $historial->gestas) }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">P (Partos)</label>
                        <input type="number" name="partos" class="form-control" placeholder="0" min="0" value="{{ old('partos', $historial->partos) }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">A (Abortos)</label>
                        <input type="number" name="abortos" class="form-control" placeholder="0" min="0" value="{{ old('abortos', $historial->abortos) }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">C (Cesáreas)</label>
                        <input type="number" name="cesareas" class="form-control" placeholder="0" min="0" value="{{ old('cesareas', $historial->cesareas) }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Hijos Vivos</label>
                        <input type="number" name="hijos_vivos" class="form-control" placeholder="0" min="0" value="{{ old('hijos_vivos', $historial->hijos_vivos) }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">N° Parejas Sexuales</label>
                        <input type="number" name="num_parejas_sexuales" class="form-control" placeholder="0" min="0" value="{{ old('num_parejas_sexuales', $historial->num_parejas_sexuales) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Métodos Anticonceptivos</label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usa_anticonceptivos" id="usa_anticonceptivos_si" value="1" {{ old('usa_anticonceptivos', $historial->usa_anticonceptivos) ? 'checked' : '' }}>
                                <label class="form-check-label" for="usa_anticonceptivos_si">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="usa_anticonceptivos" id="usa_anticonceptivos_no" value="0" {{ old('usa_anticonceptivos', $historial->usa_anticonceptivos) === 0 ? 'checked' : '' }}>
                                <label class="form-check-label" for="usa_anticonceptivos_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">¿Cuáles?</label>
                        <input type="text" name="cuales_anticonceptivos" class="form-control" value="{{ old('cuales_anticonceptivos', $historial->cuales_anticonceptivos) }}">
                    </div>
                </div>
            </div>
        </div>
         <!-- ========== ENFERMEDAD ACTUAL ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-stethoscope me-2 text-primary"></i> Enfermedad Actual
            </div>
            <div class="card-body">
                <textarea name="enfermedad_actual" class="form-control" rows="3" placeholder="Describa la enfermedad actual, síntomas, evolución...">{{ old('enfermedad_actual', $historial->enfermedad_actual) }}</textarea>
            </div>
        </div>


        <!-- ========== SIGNOS VITALES ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-heartbeat me-2 text-primary"></i> Signos Vitales
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Presión Arterial</label>
                        <input type="text" name="presion_arterial" class="form-control" placeholder="120/80" value="{{ old('presion_arterial', $historial->presion_arterial) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">FC (lpm)</label>
                        <input type="text" name="fc" class="form-control" placeholder="75" value="{{ old('fc', $historial->fc) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Sat O2 (%)</label>
                        <input type="text" name="sat" class="form-control" placeholder="98" value="{{ old('sat', $historial->sat) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">FR (rpm)</label>
                        <input type="text" name="fr" class="form-control" placeholder="16" value="{{ old('fr', $historial->fr) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Temperatura (°C)</label>
                        <input type="number" step="0.1" name="temperatura" class="form-control" placeholder="36.5" value="{{ old('temperatura', $historial->temperatura) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Peso (kg)</label>
                        <input type="number" step="0.1" name="peso" id="peso" class="form-control" placeholder="70" value="{{ old('peso', $historial->peso) }}" onchange="calcularIMC()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Talla (m)</label>
                        <input type="number" step="0.01" name="altura" id="altura" class="form-control" placeholder="1.65" value="{{ old('altura', $historial->altura) }}" onchange="calcularIMC()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">IMC (Masa Corporal)</label>
                        <input type="text" name="masa_corporal" id="masa_corporal" class="form-control" placeholder="Se calcula automáticamente" readonly value="{{ old('masa_corporal', $historial->masa_corporal) }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== EXPLORACIÓN FÍSICA ========== -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-stethoscope me-2 text-primary"></i> 
                <span class="fw-semibold">Exploración Física</span>
                <span class="badge bg-secondary ms-2">SP = Sin evidencia patológica | CP = Con evidencia patológica</span>
            </div>
            <small class="text-muted">
                <i class="fas fa-info-circle text-info me-1"></i>
                <span data-bs-toggle="tooltip" title="Seleccione CP para registrar hallazgos anormales. SP indica que no hay evidencia patológica.">
                    Seleccione CP para agregar observaciones
                </span>
            </small>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @php
                $exploraciones = [
                    ['id' => 'cabeza', 'icono' => '🧠', 'label' => 'Cabeza'],
                    ['id' => 'cuello', 'icono' => '🦴', 'label' => 'Cuello'],
                    ['id' => 'torax', 'icono' => '🫁', 'label' => 'Tórax'],
                    ['id' => 'abdomen', 'icono' => '🫃', 'label' => 'Abdomen'],
                    ['id' => 'extremidades', 'icono' => '🦵', 'label' => 'Extremidades'],
                    ['id' => 'neurologico', 'icono' => '🧠', 'label' => 'Neurológico'],
                    ['id' => 'piel', 'icono' => '🧴', 'label' => 'Piel'],
                    ['id' => 'columna', 'icono' => '🦴', 'label' => 'Columna'],
                    ['id' => 'pelvis', 'icono' => '🫃', 'label' => 'Pelvis'],
                    ['id' => 'axilas', 'icono' => '🦾', 'label' => 'Axilas'],
                    ['id' => 'mamas', 'icono' => '🫂', 'label' => 'Mamas'],
                ];
            @endphp

            @foreach($exploraciones as $exploracion)
                @php
                    $campoTipo = $exploracion['id'] . '_tipo';
                    $valorTipo = old($campoTipo, $historial->$campoTipo ?? 'SP');
                    $obsCampo = $exploracion['id'];
                    $observacion = old($obsCampo, $historial->$obsCampo ?? '');
                    $isCP = $valorTipo === 'CP';
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="border rounded-3 p-2" style="background: #fafcff; border-color: #e0e7ff !important;">
                        <div class="d-flex align-items-center gap-2">
                            <span class="fw-semibold small">
                                {{ $exploracion['icono'] }} {{ $exploracion['label'] }}
                            </span>
                            <div class="btn-group ms-auto" role="group" style="font-size: 11px;">
                                <input type="radio" class="btn-check exploracion-radio-edit" 
                                       name="{{ $exploracion['id'] }}_tipo" 
                                       id="{{ $exploracion['id'] }}_sp_edit" 
                                       value="SP" 
                                       data-target="obs_{{ $exploracion['id'] }}_edit"
                                       {{ $valorTipo === 'SP' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success btn-sm px-2 py-0" for="{{ $exploracion['id'] }}_sp_edit">
                                    SP
                                </label>
                                
                                <input type="radio" class="btn-check exploracion-radio-edit" 
                                       name="{{ $exploracion['id'] }}_tipo" 
                                       id="{{ $exploracion['id'] }}_cp_edit" 
                                       value="CP" 
                                       data-target="obs_{{ $exploracion['id'] }}_edit"
                                       {{ $valorTipo === 'CP' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger btn-sm px-2 py-0" for="{{ $exploracion['id'] }}_cp_edit">
                                    CP
                                </label>
                            </div>
                        </div>
                        <div class="mt-1">
                            <textarea name="{{ $exploracion['id'] }}" 
                                      id="obs_{{ $exploracion['id'] }}_edit" 
                                      class="form-control form-control-sm exploracion-obs-edit" 
                                      rows="1" 
                                      placeholder="Hallazgos..." 
                                      style="{{ $isCP ? 'display: block;' : 'display: none;' }} font-size: 12px;">{{ $observacion }}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

        <!-- ========== REVISIÓN DE ÓRGANOS Y SISTEMAS ========== -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-heartbeat me-2 text-primary"></i>
            <span class="fw-semibold">Revisión de Órganos y Sistemas</span>
            <span class="badge bg-secondary ms-2">SP = Sin evidencia patológica | CP = Con evidencia patológica</span>
        </div>
        
    </div>
    <div class="card-body" id="sistemasContainerEdit">
        <div class="row g-3">
            @php
                $sistemas = [
                    ['id' => 'cardiovascular', 'icono' => 'fa-heart', 'color' => 'danger', 'label' => 'Cardiovascular'],
                    ['id' => 'respiratorio', 'icono' => 'fa-lungs', 'color' => 'info', 'label' => 'Respiratorio'],
                    ['id' => 'digestivo', 'icono' => 'fa-utensils', 'color' => 'warning', 'label' => 'Digestivo'],
                    ['id' => 'renal', 'icono' => 'fa-fill-drip', 'color' => 'primary', 'label' => 'Renal'],
                    ['id' => 'neurologico', 'icono' => 'fa-brain', 'color' => 'dark', 'label' => 'Neurológico'],
                    ['id' => 'musculoesqueletico', 'icono' => 'fa-bone', 'color' => 'secondary', 'label' => 'Musculoesquelético'],
                    ['id' => 'endocrino', 'icono' => 'fa-dna', 'color' => 'success', 'label' => 'Endocrino'],
                    ['id' => 'hematologico', 'icono' => 'fa-tint', 'color' => 'danger', 'label' => 'Hematológico'],
                    ['id' => 'linfatico', 'icono' => 'fa-shield-alt', 'color' => 'info', 'label' => 'Linfático'],
                    ['id' => 'genitourinario', 'icono' => 'fa-venus-mars', 'color' => 'primary', 'label' => 'Genitourinario'],
                    ['id' => 'piel', 'icono' => 'fa-hand', 'color' => 'warning', 'label' => 'Piel y Anexos'],
                    ['id' => 'oftalmologico', 'icono' => 'fa-eye', 'color' => 'info', 'label' => 'Oftalmológico'],
                    ['id' => 'orl', 'icono' => 'fa-ear', 'color' => 'secondary', 'label' => 'Otorrinolaringológico'],
                    ['id' => 'psiquiatrico', 'icono' => 'fa-brain', 'color' => 'dark', 'label' => 'Psiquiátrico'],
                ];
            @endphp

            @foreach($sistemas as $sistema)
                @php
                    $campo = 'sist_' . $sistema['id'];
                    $obsCampo = $campo . '_obs';
                    $valor = old($campo, $historial->$campo ?? 'SP');
                    $observacion = old($obsCampo, $historial->$obsCampo ?? '');
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="border rounded-3 p-2" style="background: #fafcff;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas {{ $sistema['icono'] }} text-{{ $sistema['color'] }} me-1"></i>
                            <span class="fw-semibold small">{{ $sistema['label'] }}</span>
                            <div class="btn-group ms-auto" role="group" style="font-size: 11px;">
                                <input type="radio" class="btn-check sistema-radio-edit" 
                                       name="sist_{{ $sistema['id'] }}" 
                                       id="sist_{{ $sistema['id'] }}_sp_edit" 
                                       value="SP" 
                                       data-target="obs_sist_{{ $sistema['id'] }}_edit"
                                       {{ $valor == 'SP' ? 'checked' : '' }}>
                                <label class="btn btn-outline-success btn-sm px-2 py-0" for="sist_{{ $sistema['id'] }}_sp_edit">
                                    SP
                                </label>
                                
                                <input type="radio" class="btn-check sistema-radio-edit" 
                                       name="sist_{{ $sistema['id'] }}" 
                                       id="sist_{{ $sistema['id'] }}_cp_edit" 
                                       value="CP" 
                                       data-target="obs_sist_{{ $sistema['id'] }}_edit"
                                       {{ $valor == 'CP' ? 'checked' : '' }}>
                                <label class="btn btn-outline-danger btn-sm px-2 py-0" for="sist_{{ $sistema['id'] }}_cp_edit">
                                    CP
                                </label>
                            </div>
                        </div>
                        <div class="mt-1">
                            <textarea name="sist_{{ $sistema['id'] }}_obs" 
                                      id="obs_sist_{{ $sistema['id'] }}_edit" 
                                      class="form-control form-control-sm sistema-obs-edit" 
                                      rows="1" 
                                      placeholder="Observación..." 
                                      style="{{ $valor == 'CP' ? 'display: block;' : 'display: none;' }} font-size: 12px;">{{ $observacion }}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Observaciones generales -->
            <div class="col-12 mt-2">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <label class="form-label fw-semibold small">
                        <i class="fas fa-comment me-2 text-primary"></i>Observaciones adicionales
                    </label>
                    <textarea name="observaciones_sistemas" class="form-control form-control-sm" rows="2" placeholder="Otras observaciones sobre los sistemas...">{{ old('observaciones_sistemas', $historial->observaciones_sistemas ?? '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

      <!-- ========== ESTUDIOS COMPLEMENTARIOS ========== -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-microscope me-2 text-primary"></i> 
            <span class="fw-semibold">Estudios Complementarios</span>
            <span class="badge bg-info ms-2">Adjunta imágenes y PDFs</span>
            <span class="badge bg-secondary ms-1">{{ $historial->estudiosAdjuntos->count() }} archivos</span>
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary" id="toggleEstudiosEdit">
            <i class="fas fa-chevron-up me-1"></i> Contraer
        </button>
    </div>
    <div class="card-body" id="estudiosContainerEdit">
        <!-- ===== LABORATORIO ===== -->
        <div class="row g-2 mb-3">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-flask text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Laboratorio</label>
                                <span class="badge bg-light text-muted" id="count-laboratorio-edit">
                                    {{ $historial->estudiosAdjuntos->where('categoria', 'Laboratorio')->count() }} archivos
                                </span>
                            </div>
                            <textarea name="laboratorio" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa los exámenes de laboratorio...">{{ old('laboratorio', $historial->laboratorio) }}</textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            <!-- Archivos existentes -->
                            @if($historial->estudiosAdjuntos->where('categoria', 'Laboratorio')->count() > 0)
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    @foreach($historial->estudiosAdjuntos->where('categoria', 'Laboratorio') as $adjunto)
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-edit-{{ $adjunto->id }}">
                                            <i class="fas {{ $adjunto->icono }} text-{{ $adjunto->color }}" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $adjunto->nombre_original }}</span>
                                            <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="{{ $adjunto->id }}" style="font-size: 10px; line-height: 1;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Drop zone para nuevos archivos -->
                            <div class="drop-zone-laboratorio-edit border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-laboratorio-edit" name="archivos_laboratorio[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx" style="display: none;">
                            </div>
                            <div class="file-list-laboratorio-edit d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== ESTUDIO DE IMAGEN ===== -->
        <div class="row g-2 mb-3">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-x-ray text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Estudio de Imagen</label>
                                <span class="badge bg-light text-muted" id="count-imagen-edit">
                                    {{ $historial->estudiosAdjuntos->where('categoria', 'Imagen')->count() }} archivos
                                </span>
                            </div>
                            <textarea name="estudio_imagen" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa los estudios de imagen...">{{ old('estudio_imagen', $historial->estudio_imagen) }}</textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            @if($historial->estudiosAdjuntos->where('categoria', 'Imagen')->count() > 0)
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    @foreach($historial->estudiosAdjuntos->where('categoria', 'Imagen') as $adjunto)
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-edit-{{ $adjunto->id }}">
                                            <i class="fas {{ $adjunto->icono }} text-{{ $adjunto->color }}" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $adjunto->nombre_original }}</span>
                                            <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="{{ $adjunto->id }}" style="font-size: 10px; line-height: 1;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="drop-zone-imagen-edit border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-imagen-edit" name="archivos_imagen[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf" style="display: none;">
                            </div>
                            <div class="file-list-imagen-edit d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== OTROS ===== -->
        <div class="row g-2">
            <div class="col-12">
                <div class="border rounded-3 p-3" style="background: #f8faff; border-color: #e0e7ff !important;">
                    <div class="row g-2 align-items-start">
                        <div class="col-md-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-folder-open text-primary" style="font-size: 14px;"></i>
                                <label class="form-label fw-semibold mb-0 small">Otros Estudios</label>
                                <span class="badge bg-light text-muted" id="count-otros-edit">
                                    {{ $historial->estudiosAdjuntos->where('categoria', 'Otros')->count() }} archivos
                                </span>
                            </div>
                            <textarea name="otros_exploracion" class="form-control form-control-sm mt-1" rows="2" placeholder="Describa otros estudios complementarios...">{{ old('otros_exploracion', $historial->otros_exploracion) }}</textarea>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="fas fa-paperclip text-muted" style="font-size: 12px;"></i>
                                <span class="small text-muted">Archivos adjuntos</span>
                            </div>
                            
                            @if($historial->estudiosAdjuntos->where('categoria', 'Otros')->count() > 0)
                                <div class="d-flex flex-wrap gap-1 mb-1">
                                    @foreach($historial->estudiosAdjuntos->where('categoria', 'Otros') as $adjunto)
                                        <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;" id="archivo-edit-{{ $adjunto->id }}">
                                            <i class="fas {{ $adjunto->icono }} text-{{ $adjunto->color }}" style="font-size: 12px;"></i>
                                            <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $adjunto->nombre_original }}</span>
                                            <button type="button" class="btn btn-sm btn-danger p-0 px-1 eliminar-archivo-edit" data-id="{{ $adjunto->id }}" style="font-size: 10px; line-height: 1;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="drop-zone-otros-edit border rounded-2 p-2 text-center" style="border: 2px dashed #d1d5db; cursor: pointer; transition: all 0.2s; background: #fafafa;">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <i class="fas fa-cloud-upload-alt text-muted" style="font-size: 14px;"></i>
                                    <span class="small text-muted">Arrastra o haz clic para subir</span>
                                    <span class="badge bg-light text-muted" style="font-size: 9px;">JPG, PNG, PDF</span>
                                </div>
                                <input type="file" class="file-input-otros-edit" name="archivos_otros[]" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.xls,.xlsx" style="display: none;">
                            </div>
                            <div class="file-list-otros-edit d-flex flex-wrap gap-1 mt-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========== DIAGNÓSTICOS ========== -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3">
        <i class="fas fa-clinic-medical me-2 text-primary"></i> Diagnósticos
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="diagnosticos-table">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">#</th>
                        <th style="width: 35%">Diagnóstico</th>
                        <th style="width: 30%">Código CIE-10</th>
                        <th style="width: 20%">Tipo</th>
                        <th style="width: 10%">Acción</th>
                    </tr>
                </thead>
                <tbody id="diagnosticos-body">
                    @forelse($historial->diagnosticos as $index => $diag)
                        <tr class="diagnostico-row">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <textarea name="diagnosticos[{{ $index }}][descripcion]" class="form-control diagnostico-autocomplete" rows="2" placeholder="Escriba el diagnóstico..." data-index="{{ $index }}">{{ old("diagnosticos.{$index}.descripcion", $diag->descripcion) }}</textarea>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="diagnosticos[{{ $index }}][cie10]" id="cie10_{{ $index }}" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" value="{{ old("diagnosticos.{$index}.cie10", $diag->cie10_code) }}" data-index="{{ $index }}">
                                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="{{ $index }}" title="Limpiar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div id="cie10-results-{{ $index }}" class="cie10-results" style="display: none;"></div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[{{ $index }}][tipo]" value="PRE" {{ old("diagnosticos.{$index}.tipo", $diag->tipo) == 'PRE' ? 'checked' : '' }}>
                                        <label class="form-check-label">PRE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[{{ $index }}][tipo]" value="DEF" {{ old("diagnosticos.{$index}.tipo", $diag->tipo) == 'DEF' ? 'checked' : '' }}>
                                        <label class="form-check-label">DEF</label>
                                    </div>
                                </div>
                                <input type="hidden" name="diagnosticos[{{ $index }}][id]" value="{{ $diag->id }}">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico" {{ $historial->diagnosticos->count() <= 1 ? 'disabled' : '' }}>
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr class="diagnostico-row">
                            <td class="text-center">1</td>
                            <td>
                                <textarea name="diagnosticos[0][descripcion]" class="form-control diagnostico-autocomplete" rows="1" placeholder="Escriba el diagnóstico..." data-index="0"></textarea>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="diagnosticos[0][cie10]" id="cie10_0" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" data-index="0">
                                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="0" title="Limpiar">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div id="cie10-results-0" class="cie10-results" style="display: none;"></div>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[0][tipo]" value="PRE" checked>
                                        <label class="form-check-label">PRE</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="diagnosticos[0][tipo]" value="DEF">
                                        <label class="form-check-label">DEF</label>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico" disabled>
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary btn-sm mt-2" id="agregar-diagnostico">
            <i class="fas fa-plus me-1"></i> Agregar Diagnóstico
        </button>
        <small class="text-muted d-block mt-2">PRE = Presuntivo | DEF = Definitivo</small>
    </div>
</div>
       
        <!-- ========== TRATAMIENTO Y RECOMENDACIONES ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-pills me-2 text-primary"></i> Tratamiento y Recomendaciones
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tratamiento</label>
                    <textarea name="tratamiento" class="form-control" rows="3" placeholder="Indicaciones médicas, medicamentos, procedimientos...">{{ old('tratamiento', $historial->tratamiento) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Recomendaciones</label>
                    <textarea name="recomendaciones" class="form-control" rows="3" placeholder="Recomendaciones para el paciente...">{{ old('recomendaciones', $historial->recomendaciones) }}</textarea>
                </div>
            </div>
        </div>

        <!-- ========== OBSERVACIONES ========== -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-comment me-2 text-primary"></i> Observaciones
            </div>
            <div class="card-body">
                <textarea name="observaciones" class="form-control" rows="2" placeholder="Observaciones adicionales...">{{ old('observaciones', $historial->observaciones) }}</textarea>
            </div>
        </div>

        <!-- ========== BOTONES ========== -->
        <div class="d-flex justify-content-end gap-3 mt-4">
            <a href="{{ route('pacientes.show', $historial->paciente->id) }}" class="btn btn-secondary px-4 py-2">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary px-5 py-2">
                <i class="fas fa-save me-2"></i> Actualizar Historial
            </button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<style>
.cie10-results {
    background: white;
    border: 1px solid #ccc;
    border-radius: 4px;
    max-height: 250px;
    overflow-y: auto;
    z-index: 9999;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin-top: 2px;
    position: absolute;
    width: 90%;
}
.cie10-results-item {
    padding: 8px 12px;
    cursor: pointer;
    border-bottom: 1px solid #eee;
    font-size: 13px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.cie10-results-item:hover {
    background: #007bff;
    color: white;
}
.cie10-results-item .cie10-code {
    font-weight: bold;
    background: #e9ecef;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 12px;
    min-width: 60px;
    text-align: center;
}
.cie10-results-item:hover .cie10-code {
    background: #0056b3;
    color: white;
}
.cie10-results-item .cie10-desc {
    flex: 1;
    margin-left: 10px;
}
.cie10-results-item:hover .cie10-desc {
    color: white;
}
.selected {
    background: #007bff !important;
    color: white !important;
}
.selected .cie10-code {
    background: #0056b3 !important;
    color: white !important;
}
.selected .cie10-desc {
    color: white !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cie10SearchUrl = '{{ route("cie10.search") }}';
    const cie10ByDiagnosticoUrl = '{{ route("cie10.by-diagnostico") }}';

    function configurarFila(row) {
        const cie10Input = row.querySelector('.cie10-input');
        const diagnosticoText = row.querySelector('.diagnostico-autocomplete');
        const clearBtn = row.querySelector('.clear-cie10-row');

        if (!cie10Input) return;

        const index = cie10Input.dataset.index;
        const resultsContainerId = 'cie10-results-' + index;
        let resultsContainer = document.getElementById(resultsContainerId);
        
        if (!resultsContainer) {
            resultsContainer = document.createElement('div');
            resultsContainer.id = resultsContainerId;
            resultsContainer.className = 'cie10-results';
            resultsContainer.style.display = 'none';
            const td = row.querySelector('td:nth-child(3)');
            td.style.position = 'relative';
            td.appendChild(resultsContainer);
        }

        let searchTimeout;
        let selectedIndex = -1;
        let currentResults = [];

        function buscar(term) {
            if (term.length < 1) {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                currentResults = [];
                selectedIndex = -1;
                return;
            }

            const cleanTerm = term.replace(/\./g, '');

            fetch(cie10SearchUrl + '?q=' + encodeURIComponent(cleanTerm))
                .then(response => response.json())
                .then(data => {
                    resultsContainer.innerHTML = '';
                    currentResults = data;
                    selectedIndex = -1;
                    
                    if (data.length > 0) {
                        resultsContainer.style.display = 'block';
                        data.forEach((item, idx) => {
                            const div = document.createElement('div');
                            div.className = 'cie10-results-item';
                            div.innerHTML = `
                                <span class="cie10-code">${item.codigo}</span>
                                <span class="cie10-desc">${item.diagnostico}</span>
                            `;
                            div.dataset.codigo = item.codigo;
                            div.dataset.diagnostico = item.diagnostico;
                            div.dataset.index = idx;
                            
                            div.addEventListener('click', function(e) {
                                e.stopPropagation();
                                const codigo = this.dataset.codigo;
                                const diagnostico = this.dataset.diagnostico;
                                
                                cie10Input.value = codigo;
                                if (diagnosticoText) {
                                    diagnosticoText.value = diagnostico;
                                }
                                
                                resultsContainer.style.display = 'none';
                                resultsContainer.innerHTML = '';
                                currentResults = [];
                                selectedIndex = -1;
                                cie10Input.focus();
                                cie10Input.dispatchEvent(new Event('change'));
                            });
                            
                            div.addEventListener('mouseenter', function() {
                                document.querySelectorAll('.cie10-results-item').forEach(el => {
                                    el.classList.remove('selected');
                                });
                                this.classList.add('selected');
                                selectedIndex = parseInt(this.dataset.index);
                            });
                            
                            resultsContainer.appendChild(div);
                        });
                    } else {
                        resultsContainer.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultsContainer.style.display = 'none';
                });
        }

        // ============================================
        // EVENTO: Escribir en código CIE-10
        // ============================================
        cie10Input.addEventListener('input', function() {
            const term = this.value.trim();
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                buscar(term);
            }, 200);
        });

        // ============================================
        // EVENTO: Escribir en diagnóstico (bidireccional)
        // ============================================
        if (diagnosticoText) {
            let diagnosticoTimeout;
            
            diagnosticoText.addEventListener('input', function() {
                const term = this.value.trim();
                clearTimeout(diagnosticoTimeout);
                
                if (term.length < 2) {
                    return;
                }

                diagnosticoTimeout = setTimeout(function() {
                    fetch(cie10ByDiagnosticoUrl + '?diagnostico=' + encodeURIComponent(term))
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.codigo) {
                                cie10Input.value = data.codigo;
                                buscar(term);
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }, 300);
            });
        }

        // ============================================
        // TECLAS DE NAVEGACIÓN
        // ============================================
        cie10Input.addEventListener('keydown', function(e) {
            const items = resultsContainer.querySelectorAll('.cie10-results-item');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (items.length === 0) return;
                
                items.forEach(el => el.classList.remove('selected'));
                selectedIndex = (selectedIndex + 1) % items.length;
                items[selectedIndex].classList.add('selected');
                items[selectedIndex].scrollIntoView({ block: 'nearest' });
                
                const codigo = items[selectedIndex].dataset.codigo;
                const diagnostico = items[selectedIndex].dataset.diagnostico;
                cie10Input.value = codigo;
                if (diagnosticoText) {
                    diagnosticoText.value = diagnostico;
                }
            }
            
            if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (items.length === 0) return;
                
                items.forEach(el => el.classList.remove('selected'));
                selectedIndex = (selectedIndex - 1 + items.length) % items.length;
                items[selectedIndex].classList.add('selected');
                items[selectedIndex].scrollIntoView({ block: 'nearest' });
                
                const codigo = items[selectedIndex].dataset.codigo;
                const diagnostico = items[selectedIndex].dataset.diagnostico;
                cie10Input.value = codigo;
                if (diagnosticoText) {
                    diagnosticoText.value = diagnostico;
                }
            }
            
            if (e.key === 'Enter') {
                e.preventDefault();
                if (items.length > 0 && selectedIndex >= 0) {
                    const selected = items[selectedIndex];
                    const codigo = selected.dataset.codigo;
                    const diagnostico = selected.dataset.diagnostico;
                    
                    cie10Input.value = codigo;
                    if (diagnosticoText) {
                        diagnosticoText.value = diagnostico;
                    }
                    
                    resultsContainer.style.display = 'none';
                    resultsContainer.innerHTML = '';
                    currentResults = [];
                    selectedIndex = -1;
                    cie10Input.focus();
                } else {
                    const val = this.value.trim();
                    if (val.length >= 1) {
                        const cleanVal = val.replace(/\./g, '');
                        fetch(cie10SearchUrl + '?q=' + encodeURIComponent(cleanVal))
                            .then(response => response.json())
                            .then(data => {
                                if (data.length > 0) {
                                    const item = data[0];
                                    cie10Input.value = item.codigo;
                                    if (diagnosticoText) {
                                        diagnosticoText.value = item.diagnostico;
                                    }
                                    resultsContainer.style.display = 'none';
                                    resultsContainer.innerHTML = '';
                                    currentResults = [];
                                    selectedIndex = -1;
                                }
                            });
                    }
                }
            }
            
            if (e.key === 'Escape') {
                resultsContainer.style.display = 'none';
                resultsContainer.innerHTML = '';
                currentResults = [];
                selectedIndex = -1;
            }
        });

        // ============================================
        // OCULTAR RESULTADOS
        // ============================================
        cie10Input.addEventListener('blur', function() {
            setTimeout(function() {
                resultsContainer.style.display = 'none';
            }, 300);
        });

        // ============================================
        // BOTÓN LIMPIAR
        // ============================================
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                cie10Input.value = '';
                if (diagnosticoText) {
                    diagnosticoText.value = '';
                }
                resultsContainer.innerHTML = '';
                resultsContainer.style.display = 'none';
                currentResults = [];
                selectedIndex = -1;
                cie10Input.focus();
            });
        }

        // Click fuera para cerrar
        document.addEventListener('click', function(e) {
            if (!row.contains(e.target)) {
                resultsContainer.style.display = 'none';
            }
        });
    }

    // ============================================
    // CONFIGURAR FILAS EXISTENTES
    // ============================================
    document.querySelectorAll('.diagnostico-row').forEach(function(row) {
        configurarFila(row);
    });

    // ============================================
    // AGREGAR NUEVA FILA
    // ============================================
    document.getElementById('agregar-diagnostico').addEventListener('click', function() {
        const tbody = document.getElementById('diagnosticos-body');
        const rowCount = tbody.querySelectorAll('.diagnostico-row').length;
        const newIndex = rowCount;
        
        const tr = document.createElement('tr');
        tr.className = 'diagnostico-row';
        tr.innerHTML = `
            <td class="text-center">${rowCount + 1}</td>
            <td>
                <textarea name="diagnosticos[${newIndex}][descripcion]" class="form-control diagnostico-autocomplete" rows="1" placeholder="Escriba el diagnóstico..." data-index="${newIndex}"></textarea>
            </td>
            <td style="position: relative;">
                <div class="input-group">
                    <input type="text" name="diagnosticos[${newIndex}][cie10]" id="cie10_${newIndex}" class="form-control cie10-input" placeholder="Ej: E119" autocomplete="off" data-index="${newIndex}">
                    <button type="button" class="btn btn-outline-secondary clear-cie10-row" data-index="${newIndex}" title="Limpiar">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div id="cie10-results-${newIndex}" class="cie10-results" style="display: none;"></div>
            </td>
            <td>
                <div class="d-flex gap-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnosticos[${newIndex}][tipo]" value="PRE" checked>
                        <label class="form-check-label">PRE</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="diagnosticos[${newIndex}][tipo]" value="DEF">
                        <label class="form-check-label">DEF</label>
                    </div>
                </div>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm eliminar-diagnostico">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
        
        tbody.appendChild(tr);
        configurarFila(tr);
        actualizarBotonesEliminar();
        actualizarNumeros();
    });

    function actualizarBotonesEliminar() {
        const rows = document.querySelectorAll('.diagnostico-row');
        const buttons = document.querySelectorAll('.eliminar-diagnostico');
        
        buttons.forEach((btn) => {
            if (rows.length <= 1) {
                btn.disabled = true;
            } else {
                btn.disabled = false;
            }
        });
    }

    function actualizarNumeros() {
        document.querySelectorAll('.diagnostico-row').forEach((row, index) => {
            row.querySelector('td:first-child').textContent = index + 1;
        });
    }

    document.getElementById('diagnosticos-body').addEventListener('click', function(e) {
        if (e.target.closest('.eliminar-diagnostico')) {
            const btn = e.target.closest('.eliminar-diagnostico');
            const row = btn.closest('.diagnostico-row');
            if (document.querySelectorAll('.diagnostico-row').length > 1) {
                row.remove();
                actualizarNumeros();
                actualizarBotonesEliminar();
            }
        }
    });

    actualizarBotonesEliminar();
});
// ============================================
// CONFIGURAR DROP ZONES EN EDIT
// ============================================
function configurarDropZoneEdit(zoneClass, inputClass, listClass, countClass, categoria) {
    const dropZone = document.querySelector(zoneClass);
    const fileInput = document.querySelector(inputClass);
    const fileList = document.querySelector(listClass);
    const countBadge = document.getElementById(countClass);
    let archivos = [];

    if (!dropZone || !fileInput) return;

    // Click
    dropZone.addEventListener('click', function(e) {
        e.stopPropagation();
        fileInput.click();
    });

    // Drag and drop
    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#4f46e5';
        this.style.background = '#eef2ff';
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#d1d5db';
        this.style.background = '#fafafa';
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#d1d5db';
        this.style.background = '#fafafa';
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            agregarArchivosEdit(files, archivos, fileList, countBadge, categoria);
        }
    });

    fileInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            agregarArchivosEdit(this.files, archivos, fileList, countBadge, categoria);
        }
        this.value = '';
    });

    // Actualizar contador inicial
    if (countBadge) {
        const existingFiles = fileList.querySelectorAll('.border').length;
        const count = parseInt(countBadge.textContent) || 0;
        if (count === 0 && existingFiles === 0) {
            countBadge.textContent = '0 archivos';
        }
    }

    return {
        getArchivos: function() { return archivos; },
        limpiar: function() { archivos = []; fileList.innerHTML = ''; if (countBadge) countBadge.textContent = '0 archivos'; }
    };
}

function agregarArchivosEdit(files, archivosArray, fileList, countBadge, categoria) {
    const maxSize = 10 * 1024 * 1024;
    const formatosPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 
                                 'application/pdf', 'application/msword', 
                                 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                 'application/vnd.ms-excel', 
                                 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    for (let file of files) {
        if (file.size > maxSize) {
            mostrarAlertaEdit(`❌ ${file.name} excede 10MB`, 'danger');
            continue;
        }
        if (!formatosPermitidos.includes(file.type)) {
            mostrarAlertaEdit(`❌ ${file.name} formato no permitido`, 'danger');
            continue;
        }
        const existe = archivosArray.some(a => a.name === file.name && a.size === file.size);
        if (!existe) {
            archivosArray.push(file);
        }
    }
    renderizarArchivosEdit(archivosArray, fileList, countBadge, categoria);
}

function renderizarArchivosEdit(archivosArray, fileList, countBadge, categoria) {
    if (archivosArray.length === 0) {
        fileList.innerHTML = '';
        if (countBadge) {
            const existing = fileList.parentElement.querySelectorAll('.border').length;
            countBadge.textContent = existing + ' archivos';
        }
        return;
    }

    let html = '';
    archivosArray.forEach((file, index) => {
        const icono = getIconoArchivo(file.type);
        const color = getColorArchivo(file.type);
        const tamaño = file.size > 1048576 ? (file.size / 1048576).toFixed(1) + 'MB' : (file.size / 1024).toFixed(0) + 'KB';
        html += `
            <div class="border rounded-2 px-2 py-1 d-flex align-items-center gap-1" style="background: #fff; font-size: 12px;">
                <i class="fas ${icono} text-${color}" style="font-size: 12px;"></i>
                <span style="max-width: 80px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">${file.name}</span>
                <span class="text-muted" style="font-size: 9px;">${tamaño}</span>
                <button type="button" class="btn btn-sm btn-danger p-0 px-1" onclick="this.closest('.border').remove()" style="font-size: 10px; line-height: 1;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
    });

    fileList.innerHTML = html;
    if (countBadge) countBadge.textContent = archivosArray.length + ' archivos';
}

// ============================================
// ELIMINAR ARCHIVOS EXISTENTES EN EDIT
// ============================================
document.querySelectorAll('.eliminar-archivo-edit').forEach(function(btn) {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const contenedor = document.getElementById('archivo-edit-' + id);
        if (contenedor && confirm('¿Eliminar este archivo?')) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'eliminar_archivos[]';
            input.value = id;
            document.querySelector('form').appendChild(input);
            contenedor.style.display = 'none';
            
            // Actualizar contador de la categoría
            const categoria = contenedor.closest('.col-md-7').previousElementSibling.querySelector('.badge');
            if (categoria) {
                const count = parseInt(categoria.textContent) || 0;
                categoria.textContent = Math.max(0, count - 1) + ' archivos';
            }
        }
    });
});

// ============================================
// INICIALIZAR DROP ZONES EN EDIT
// ============================================
configurarDropZoneEdit('.drop-zone-laboratorio-edit', '.file-input-laboratorio-edit', '.file-list-laboratorio-edit', 'count-laboratorio-edit', 'laboratorio');
configurarDropZoneEdit('.drop-zone-imagen-edit', '.file-input-imagen-edit', '.file-list-imagen-edit', 'count-imagen-edit', 'imagen');
configurarDropZoneEdit('.drop-zone-otros-edit', '.file-input-otros-edit', '.file-list-otros-edit', 'count-otros-edit', 'otros');

// ============================================
// TOGGLE CONTRAER/EXPANDIR EN EDIT
// ============================================
document.getElementById('toggleEstudiosEdit')?.addEventListener('click', function() {
    const container = document.getElementById('estudiosContainerEdit');
    const icon = this.querySelector('i');
    if (container.style.display === 'none') {
        container.style.display = 'block';
        icon.className = 'fas fa-chevron-up me-1';
        this.innerHTML = '<i class="fas fa-chevron-up me-1"></i> Contraer';
    } else {
        container.style.display = 'none';
        icon.className = 'fas fa-chevron-down me-1';
        this.innerHTML = '<i class="fas fa-chevron-down me-1"></i> Expandir';
    }
});

// ============================================
// FUNCIONES AUXILIARES
// ============================================
function getIconoArchivo(mimeType) {
    const iconos = {
        'image/jpeg': 'fa-file-image', 'image/png': 'fa-file-image', 'image/gif': 'fa-file-image',
        'image/webp': 'fa-file-image', 'application/pdf': 'fa-file-pdf',
        'application/msword': 'fa-file-word',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'fa-file-word',
        'application/vnd.ms-excel': 'fa-file-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'fa-file-excel',
    };
    return iconos[mimeType] || 'fa-file';
}

function getColorArchivo(mimeType) {
    const colores = {
        'image/jpeg': 'primary', 'image/png': 'primary', 'image/gif': 'primary',
        'image/webp': 'primary', 'application/pdf': 'danger',
        'application/msword': 'info',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document': 'info',
        'application/vnd.ms-excel': 'success',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': 'success',
    };
    return colores[mimeType] || 'secondary';
}

function mostrarAlertaEdit(mensaje, tipo = 'danger') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show py-1 px-2 mb-1`;
    alerta.role = 'alert';
    alerta.style.fontSize = '12px';
    alerta.innerHTML = `${mensaje} <button type="button" class="btn-close p-1" data-bs-dismiss="alert" style="font-size: 10px;"></button>`;
    const container = document.querySelector('#estudiosContainerEdit');
    if (container) {
        container.prepend(alerta);
        setTimeout(() => alerta.remove(), 4000);
    }
}
// ============================================
// TOGGLE PARA SISTEMAS EN EDIT
// ============================================
document.querySelectorAll('.sistema-toggle-edit').forEach(function(checkbox) {
    const targetId = checkbox.dataset.target;
    const textarea = document.getElementById(targetId);
    
    checkbox.addEventListener('change', function() {
        if (textarea) {
            if (this.checked) {
                textarea.style.display = 'block';
                textarea.focus();
            } else {
                textarea.style.display = 'none';
                textarea.value = '';
            }
        }
    });
});

// ============================================
// TOGGLE PARA SISTEMAS EN EDIT - SP / CP
// ============================================
document.querySelectorAll('.sistema-radio-edit').forEach(function(radio) {
    const targetId = radio.dataset.target;
    const textarea = document.getElementById(targetId);
    
    radio.addEventListener('change', function() {
        if (textarea) {
            if (this.value === 'CP' && this.checked) {
                textarea.style.display = 'block';
                textarea.focus();
            } else if (this.value === 'SP' && this.checked) {
                textarea.style.display = 'none';
                textarea.value = '';
            }
        }
    });
});

// ============================================
// TOGGLE CONTRAER/EXPANDIR EN EDIT
// ============================================
document.getElementById('toggleSistemasEdit')?.addEventListener('click', function() {
    const container = document.getElementById('sistemasContainerEdit');
    const icon = this.querySelector('i');
    if (container.style.display === 'none') {
        container.style.display = 'block';
        icon.className = 'fas fa-chevron-up me-1';
        this.innerHTML = '<i class="fas fa-chevron-up me-1"></i> Contraer';
    } else {
        container.style.display = 'none';
        icon.className = 'fas fa-chevron-down me-1';
        this.innerHTML = '<i class="fas fa-chevron-down me-1"></i> Expandir';
    }
});
//-------------------------------------
// ============================================
// TOGGLE PARA EXPLORACIÓN FÍSICA - SP / CP
// ============================================
// Para CREATE
document.querySelectorAll('.exploracion-radio').forEach(function(radio) {
    const targetId = radio.dataset.target;
    const textarea = document.getElementById(targetId);
    
    radio.addEventListener('change', function() {
        if (textarea) {
            if (this.value === 'CP' && this.checked) {
                textarea.style.display = 'block';
                textarea.focus();
            } else if (this.value === 'SP' && this.checked) {
                textarea.style.display = 'none';
                textarea.value = '';
            }
        }
    });

    // Verificar estado inicial
    if (radio.value === 'CP' && radio.checked && textarea) {
        textarea.style.display = 'block';
    }
});

// Para EDIT
document.querySelectorAll('.exploracion-radio-edit').forEach(function(radio) {
    const targetId = radio.dataset.target;
    const textarea = document.getElementById(targetId);
    
    radio.addEventListener('change', function() {
        if (textarea) {
            if (this.value === 'CP' && this.checked) {
                textarea.style.display = 'block';
                textarea.focus();
            } else if (this.value === 'SP' && this.checked) {
                textarea.style.display = 'none';
                textarea.value = '';
            }
        }
    });
});
</script>
@endpush