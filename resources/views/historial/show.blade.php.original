@extends('layouts.app')

@section('title', 'Detalle del Historial Clínico')
@section('page-title', 'Expediente Médico')

@section('content')
<div class="container-fluid px-0">
    
    <!-- ========== ENCABEZADO DEL PACIENTE ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-4" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-injured fa-2x text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $historial->paciente->nombre_completo }}</h4>
                        <div class="d-flex flex-wrap gap-2 align-items-center" style="font-size: 13px;">
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-id-card me-1"></i> {{ $historial->paciente->cedula ?? 'S/C' }}</span>
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-birthday-cake me-1"></i> {{ $historial->paciente->edad }} años</span>
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-phone me-1"></i> {{ $historial->paciente->telefono ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="badge bg-white text-primary px-3 py-2 rounded-pill fs-6 mb-1 shadow-sm">
                        <i class="fas fa-id-card me-2"></i>
                        {{ $historial->paciente->cedula ?? 'SIN-CÉDULA' }}
                        <span class="mx-2">|</span>
                        <i class="far fa-calendar-alt me-1"></i>
                        {{ $historial->fecha_consulta->format('Ymd') }}
                    </div>
                    <div class="text-white-50 small"><i class="far fa-calendar-alt me-1"></i> {{ $historial->fecha_consulta->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== DATOS DE LA CONSULTA ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-stethoscope"></i></span>
                Datos de la Consulta
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-3">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Fecha</span>
                    <span class="text-dark fw-medium">{{ $historial->fecha_consulta->format('d/m/Y') }}</span>
                </div>
                <div class="col-md-3">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Doctor Responsable</span>
                    <span class="text-dark fw-medium"><i class="fas fa-user-md text-primary me-1"></i> {{ $historial->doctor ?? 'No registrado' }}</span>
                </div>
                <div class="col-md-6">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Motivo de Consulta</span>
                    <div class="p-3 bg-light rounded-3 text-dark border">{{ $historial->motivo_consulta ?? 'No registrado' }}</div>
                </div>
                <div class="col-12 mt-4">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Enfermedad Actual</span>
                    <p class="text-dark mb-0 lh-lg">{{ $historial->enfermedad_actual ?? 'No registra' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== SECCIÓN: SIGNOS VITALES ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-danger bg-opacity-10 text-danger rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-heartbeat"></i></span>
                Signos Vitales
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3">
                @php
                    $vitales = [
                        ['label' => 'Presión Arterial', 'val' => $historial->presion_arterial, 'icon' => 'fa-tachometer-alt', 'color' => 'primary'],
                        ['label' => 'Frec. Cardíaca', 'val' => $historial->fc ? $historial->fc.' lpm' : null, 'icon' => 'fa-heart', 'color' => 'danger'],
                        ['label' => 'Sat O2', 'val' => $historial->sat ? $historial->sat.' %' : null, 'icon' => 'fa-lungs', 'color' => 'info'],
                        ['label' => 'Frec. Respiratoria', 'val' => $historial->fr ? $historial->fr.' rpm' : null, 'icon' => 'fa-wind', 'color' => 'secondary'],
                        ['label' => 'Temperatura', 'val' => $historial->temperatura ? $historial->temperatura.' °C' : null, 'icon' => 'fa-thermometer-half', 'color' => 'warning'],
                        ['label' => 'IMC', 'val' => $historial->imc ? $historial->imc.' kg/m²' : null, 'icon' => 'fa-weight', 'color' => 'success']
                    ];
                @endphp
                @foreach($vitales as $vital)
                <div class="col-md-4 col-lg-2">
                    <div class="border rounded-3 p-3 text-center h-100 bg-light transition-hover">
                        <i class="fas {{ $vital['icon'] }} text-{{ $vital['color'] }} mb-2 fs-5"></i>
                        <div class="small text-muted fw-semibold mb-1">{{ $vital['label'] }}</div>
                        <div class="fw-bold text-dark">{{ $vital['val'] ?? 'N/A' }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <!-- ========== ANTECEDENTES PERSONALES PATOLÓGICOS ========== -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-warning bg-opacity-10 text-warning rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-file-medical-alt"></i></span>
                        Antecedentes Patológicos
                    </h6>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-3">
                        @php
                            $patologicos = [
                                'hospitalizaciones' => 'Hospitalizaciones', 'cardiovasculares' => 'Cardiovasculares',
                                'pulmonales' => 'Pulmonares', 'digestivos' => 'Digestivos',
                                'diabetes' => 'Diabetes', 'renales' => 'Renales',
                                'quirurgicos' => 'Quirúrgicos', 'transfusiones' => 'Transfusiones',
                                'alergias_patologicas' => 'Alergias', 'otros_patologicos' => 'Otros'
                            ];
                        @endphp
                        <ul class="list-group list-group-flush w-100">
                        @foreach($patologicos as $campo => $label)
                            <li class="list-group-item d-flex justify-content-between align-items-start px-0 bg-transparent border-light py-2">
                                <span class="text-muted small fw-medium">{{ $label }}</span>
                                <span class="text-dark text-end ms-3" style="font-size: 13px;">{{ $historial->$campo ?? 'No registra' }}</span>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- ========== ANTECEDENTES NO PATOLÓGICOS Y FAMILIARES ========== -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-success bg-opacity-10 text-success rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-leaf"></i></span>
                        No Patológicos y Familiares
                    </h6>
                </div>
                <div class="card-body p-4 pt-2">
                    <h6 class="small fw-bold text-muted text-uppercase mb-3">Hábitos</h6>
                    <div class="d-flex flex-wrap gap-2 mb-4">
                        @php
                            $noPatologicos = [
                                'alcohol' => ['Alcohol', 'fa-glass-cheers'], 'tabaquismo' => ['Tabaquismo', 'fa-smoking'],
                                'drogas' => ['Drogas', 'fa-capsules'], 'inmunizaciones' => ['Inmunizaciones', 'fa-syringe'],
                                'otros_no_patologicos' => ['Otros', 'fa-asterisk']
                            ];
                        @endphp
                        @foreach($noPatologicos as $campo => $data)
                            <div class="border rounded px-3 py-2 bg-light w-100 d-flex justify-content-between">
                                <span class="small text-muted"><i class="fas {{ $data[1] }} me-2 text-secondary"></i>{{ $data[0] }}</span>
                                <span class="small text-dark">{{ $historial->$campo ?? 'No registra' }}</span>
                            </div>
                        @endforeach
                    </div>

                    <h6 class="small fw-bold text-muted text-uppercase mb-3 mt-4 border-top pt-3">Familiares</h6>
                    @if($historial->familiares_no_refiere)
                        <div class="alert alert-light border text-muted small py-2"><i class="fas fa-info-circle me-2"></i>No refiere antecedentes familiares</div>
                    @else
                        @php
                            $familiares = [
                                'familiar_hipertension' => 'Hipertensión', 'familiar_diabetes' => 'Diabetes',
                                'familiar_cardiopatias' => 'Cardiopatías', 'familiar_cancer' => 'Cáncer',
                                'familiar_obesidad' => 'Obesidad', 'familiar_dislipidemia' => 'Dislipidemia',
                                'familiar_enfermedad_renal' => 'Enf. Renal', 'familiar_enfermedad_tiroidea' => 'Enf. Tiroidea',
                                'familiar_enfermedad_mental' => 'Enf. Mental', 'familiar_tuberculosis' => 'Tuberculosis',
                                'familiar_alcoholismo' => 'Alcoholismo', 'familiar_otras' => 'Otras'
                            ];
                            $hayFamiliares = false;
                        @endphp
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($familiares as $campo => $label)
                                @if($historial->$campo)
                                    @php $hayFamiliares = true; @endphp
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary px-2 py-1 fw-normal">
                                        <i class="fas fa-check me-1"></i> {{ $label }}
                                    </span>
                                @endif
                            @endforeach
                            @if(!$hayFamiliares)
                                <div class="alert alert-light border text-muted small py-2 w-100"><i class="fas fa-info-circle me-2"></i>No refiere antecedentes familiares</div>
                            @endif
                        </div>
                        @if($historial->antecedentes_familiares)
                            <div class="mt-3 p-3 bg-light rounded small text-dark border">
                                <strong class="text-muted d-block mb-1">Observaciones:</strong>
                                {{ $historial->antecedentes_familiares }}
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ========== GINECO OBSTÉTRICOS (SI APLICA) ========== -->
    @if($historial->paciente->genero == 'F' || $historial->paciente->genero == 'Otro')
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-info bg-opacity-10 text-info rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-venus"></i></span>
                Antecedentes Gineco Obstétricos
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-3 text-center">
                @php
                    $gineco = [
                        'menarquia' => 'Menarquia', 'ritmo' => 'Ritmo', 'fmu' => 'F.M.U', 'menopausia' => 'Menopausia',
                        'gestas' => 'Gestas', 'partos' => 'Partos', 'abortos' => 'Abortos', 'cesareas' => 'Cesáreas',
                        'hijos_vivos' => 'Hijos Vivos', 'num_parejas_sexuales' => 'Parejas Sex.'
                    ];
                @endphp
                @foreach($gineco as $campo => $label)
                    <div class="col-md-3 col-lg-2 col-6 border-end border-bottom pb-3">
                        <span class="d-block text-muted small fw-semibold">{{ $label }}</span>
                        <span class="text-dark fw-bold fs-6">{{ $historial->$campo ?? '-' }}</span>
                    </div>
                @endforeach
                <div class="col-md-6 col-lg-4 text-start pt-3 border-top">
                    <span class="text-muted small fw-semibold me-2">Usa Anticonceptivos:</span>
                    <span class="badge {{ $historial->usa_anticonceptivos ? 'bg-success' : 'bg-secondary' }} rounded-pill px-3">{{ $historial->usa_anticonceptivos ? 'Sí' : 'No' }}</span>
                    @if($historial->usa_anticonceptivos)
                        <div class="mt-1 small text-dark"><strong>Cuáles:</strong> {{ $historial->cuales_anticonceptivos ?? 'No especifica' }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- ========== EXPLORACIÓN FÍSICA Y SISTEMAS ========== -->
    <div class="row">
        <!-- EXPLORACIÓN FÍSICA -->
        @php
            $exploraciones = [
                ['id' => 'cabeza', 'label' => 'Cabeza'], ['id' => 'cuello', 'label' => 'Cuello'],
                ['id' => 'torax', 'label' => 'Tórax'], ['id' => 'abdomen', 'label' => 'Abdomen'],
                ['id' => 'extremidades', 'label' => 'Extremidades'], ['id' => 'neurologico', 'label' => 'Neurológico'],
                ['id' => 'piel', 'label' => 'Piel'], ['id' => 'columna', 'label' => 'Columna'],
                ['id' => 'pelvis', 'label' => 'Pelvis'], ['id' => 'axilas', 'label' => 'Axilas'],
                ['id' => 'mamas', 'label' => 'Mamas']
            ];
            $tieneCP = collect($exploraciones)->contains(fn($e) => ($historial->{$e['id'].'_tipo'} ?? 'SP') === 'CP');
        @endphp
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-male"></i></span>
                        Exploración Física
                    </h6>
                    <span class="badge {{ $tieneCP ? 'bg-danger' : 'bg-success' }} rounded-pill fw-normal">{{ $tieneCP ? 'Hallazgos patológicos' : 'Sin alteraciones' }}</span>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-2">
                        @foreach($exploraciones as $exploracion)
                            @php
                                $campoTipo = $exploracion['id'] . '_tipo';
                                $esCP = ($historial->$campoTipo ?? 'SP') === 'CP';
                                $observacion = $historial->{$exploracion['id']} ?? '';
                            @endphp
                            <div class="col-md-6">
                                <div class="border rounded px-3 py-2 h-100 {{ $esCP ? 'border-danger bg-danger bg-opacity-10' : 'bg-light border-light' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small fw-semibold {{ $esCP ? 'text-danger' : 'text-muted' }}">{{ $exploracion['label'] }}</span>
                                        <span class="badge {{ $esCP ? 'bg-danger' : 'bg-secondary bg-opacity-25 text-secondary' }}" style="font-size: 10px;">{{ $esCP ? 'CP' : 'SP' }}</span>
                                    </div>
                                    @if($esCP && $observacion)
                                        <div class="text-dark mt-1" style="font-size: 12px; line-height: 1.3;">{{ $observacion }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- REVISIÓN DE SISTEMAS -->
        @php
            $sistemas = [
                ['id' => 'cardiovascular', 'label' => 'Cardiovascular'], ['id' => 'respiratorio', 'label' => 'Respiratorio'],
                ['id' => 'digestivo', 'label' => 'Digestivo'], ['id' => 'renal', 'label' => 'Renal'],
                ['id' => 'neurologico', 'label' => 'Neurológico'], ['id' => 'musculoesqueletico', 'label' => 'Musculoesquelético'],
                ['id' => 'endocrino', 'label' => 'Endocrino'], ['id' => 'hematologico', 'label' => 'Hematológico'],
                ['id' => 'linfatico', 'label' => 'Linfático'], ['id' => 'genitourinario', 'label' => 'Genitourinario'],
                ['id' => 'piel', 'label' => 'Piel/Anexos'], ['id' => 'oftalmologico', 'label' => 'Oftalmológico'],
                ['id' => 'orl', 'label' => 'Otorrinolaringológico'], ['id' => 'psiquiatrico', 'label' => 'Psiquiátrico']
            ];
            $tieneCPSistemas = collect($sistemas)->contains(fn($s) => ($historial->{'sist_'.$s['id']} ?? 'SP') === 'CP');
        @endphp
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 mb-4 h-100">
                <div class="card-header bg-transparent border-0 pt-4 pb-2 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                        <span class="icon-box bg-secondary bg-opacity-10 text-secondary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-project-diagram"></i></span>
                        Órganos y Sistemas
                    </h6>
                    <span class="badge {{ $tieneCPSistemas ? 'bg-danger' : 'bg-success' }} rounded-pill fw-normal">{{ $tieneCPSistemas ? 'Hallazgos patológicos' : 'Sin alteraciones' }}</span>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="row g-2">
                        @foreach($sistemas as $sistema)
                            @php
                                $campo = 'sist_' . $sistema['id'];
                                $esCP = ($historial->$campo ?? 'SP') === 'CP';
                                $observacion = $historial->{$campo.'_obs'} ?? '';
                            @endphp
                            <div class="col-md-6">
                                <div class="border rounded px-3 py-2 h-100 {{ $esCP ? 'border-danger bg-danger bg-opacity-10' : 'bg-light border-light' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small fw-semibold {{ $esCP ? 'text-danger' : 'text-muted' }}">{{ $sistema['label'] }}</span>
                                        <span class="badge {{ $esCP ? 'bg-danger' : 'bg-secondary bg-opacity-25 text-secondary' }}" style="font-size: 10px;">{{ $esCP ? 'CP' : 'SP' }}</span>
                                    </div>
                                    @if($esCP && $observacion)
                                        <div class="text-dark mt-1" style="font-size: 12px; line-height: 1.3;">{{ $observacion }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($historial->observaciones_sistemas)
                        <div class="mt-3 p-3 bg-light rounded border small text-dark">
                            <strong class="text-primary d-block mb-1"><i class="fas fa-info-circle me-1"></i> Observaciones adicionales:</strong>
                            {{ $historial->observaciones_sistemas }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ========== DIAGNÓSTICOS, TRATAMIENTO Y ADJUNTOS ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-clinic-medical"></i></span>
                Resolución Clínica
            </h6>
        </div>
        <div class="card-body p-4">
            <h6 class="small fw-bold text-muted text-uppercase mb-3">Diagnósticos Registrados</h6>
            @if($historial->diagnosticos->count() > 0)
                <div class="table-responsive mb-4">
                    <table class="table table-borderless align-middle rounded overflow-hidden">
                        <thead class="bg-light text-muted small text-uppercase">
                            <tr>
                                <th class="ps-3 py-3 rounded-start">Diagnóstico</th>
                                <th class="py-3">CIE-10</th>
                                <th class="py-3 rounded-end text-end pe-3">Tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historial->diagnosticos as $diag)
                                <tr class="border-bottom">
                                    <td class="ps-3 py-3 fw-medium text-dark">{{ $diag->descripcion }}</td>
                                    <td class="py-3"><span class="badge bg-light text-dark border">{{ $diag->cie10_code ?? 'N/E' }}</span></td>
                                    <td class="py-3 text-end pe-3">
                                        <span class="badge {{ $diag->tipo == 'PRE' ? 'bg-warning text-dark' : 'bg-success' }} rounded-pill px-3">
                                            {{ $diag->tipo == 'PRE' ? 'Presuntivo' : 'Definitivo' }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-light border text-muted py-3 mb-4"><i class="fas fa-exclamation-circle me-2"></i>No hay diagnósticos registrados.</div>
            @endif

            <div class="row g-4 mt-2">
                <div class="col-md-6 border-end">
                    <h6 class="small fw-bold text-muted text-uppercase mb-2"><i class="fas fa-pills me-2 text-primary"></i>Plan de Tratamiento</h6>
                    <div class="p-3 bg-light rounded-3 text-dark border h-100" style="white-space: pre-wrap;">{{ $historial->tratamiento ?? 'No registra' }}</div>
                </div>
                <div class="col-md-6">
                    <h6 class="small fw-bold text-muted text-uppercase mb-2"><i class="fas fa-clipboard-list me-2 text-primary"></i>Recomendaciones</h6>
                    <div class="p-3 bg-light rounded-3 text-dark border h-100" style="white-space: pre-wrap;">{{ $historial->recomendaciones ?? 'No registra' }}</div>
                </div>
            </div>

            <div class="row g-4 mt-2 border-top pt-2">
                <div class="col-12">
                    <h6 class="small fw-bold text-muted text-uppercase mb-3 mt-3"><i class="fas fa-microscope me-2 text-primary"></i>Estudios Complementarios & Adjuntos</h6>
                    <div class="row g-3">
                        @foreach(['Laboratorio' => ['flask', 'primary'], 'Imagen' => ['x-ray', 'info'], 'Otros' => ['folder-open', 'secondary']] as $categoria => $icon)
                        <div class="col-md-4">
                            <div class="border rounded-3 p-3 h-100 bg-light border-light">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fas fa-{{ $icon[0] }} text-{{ $icon[1] }}"></i>
                                    <span class="fw-bold text-dark small">{{ $categoria }}</span>
                                </div>
                                @php $campoTexto = strtolower($categoria) == 'otros' ? 'otros_exploracion' : (strtolower($categoria) == 'imagen' ? 'estudio_imagen' : strtolower($categoria)); @endphp
                                <p class="small text-muted mb-3">{{ $historial->$campoTexto ?? 'No requiere' }}</p>
                                
                                @if($historial->estudiosAdjuntos->where('categoria', $categoria)->count() > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($historial->estudiosAdjuntos->where('categoria', $categoria) as $adjunto)
                                            <a href="{{ route('adjuntos.download', $adjunto) }}" target="_blank" class="btn btn-sm btn-white border shadow-sm rounded-pill py-1 px-3" style="font-size: 11px;">
                                                <i class="fas {{ $adjunto->icono }} text-{{ $adjunto->color }} me-1"></i> {{ Str::limit($adjunto->nombre_original, 15) }}
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            @if($historial->observaciones)
            <div class="mt-4 pt-3 border-top">
                <h6 class="small fw-bold text-muted text-uppercase mb-2"><i class="fas fa-comment-dots me-2 text-primary"></i>Observaciones Generales</h6>
                <p class="text-dark small mb-0">{{ $historial->observaciones }}</p>
            </div>
            @endif
        </div>
    </div>

    <!-- ========== PANEL DE ACCIONES E HISTORIALES RELACIONADOS ========== -->
    <div class="card border-0 shadow-sm rounded-4 mb-5" style="background-color: var(--gray-bg);">
        <div class="card-body p-4 text-center d-flex flex-wrap justify-content-center gap-2">
            <a href="{{ route('pacientes.show', $historial->paciente->id) }}" class="btn btn-light border px-4 rounded-pill shadow-sm text-dark fw-medium">
                <i class="fas fa-arrow-left me-2"></i> Volver al Paciente
            </a>
            @can('editar historiales')
            <a href="{{ route('historial.edit', $historial->id) }}" class="btn btn-warning px-4 rounded-pill shadow-sm text-dark fw-medium">
                <i class="fas fa-edit me-1"></i> Editar Historial
            </a>
            @endcan
            
            <!-- Recetas / Certificados / Reposos -->
            <div class="btn-group shadow-sm ms-md-auto">
                @if($historial->recetas->count() > 0)
                    <a href="{{ route('recetas.index', $historial) }}" class="btn" style="background-color: #6366f1; color: white;">
                        <i class="fas fa-prescription-bottle-alt me-1"></i> Recetas ({{ $historial->recetas->count() }})
                    </a>
                @endif
                <a href="{{ route('certificados.create', $historial) }}" class="btn btn-info text-white">
                    <i class="fas fa-certificate me-1"></i> Certificado
                </a>
                <a href="{{ route('reposos.create', $historial) }}" class="btn btn-secondary text-white">
                    <i class="fas fa-bed me-1"></i> Reposo Médico
                </a>
                <a href="{{ route('reportes.historial', $historial) }}" target="_blank" class="btn btn-success text-white">
                    <i class="fas fa-print me-1"></i> Imprimir PDF
                </a>
            </div>

            @if(auth()->user()->hasAnyRole(['Administrador', 'Médico']))
            <button type="button" class="btn btn-outline-danger px-4 rounded-pill ms-md-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fas fa-trash me-1"></i> Eliminar
            </button>
            @endif
        </div>
    </div>

</div>

<!-- ========== MODAL ELIMINAR ========== -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-danger text-white border-0 p-4">
                <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <i class="fas fa-trash-alt fa-3x text-danger opacity-50 mb-3"></i>
                <p class="fs-5 text-dark mb-1">¿Estás seguro de eliminar este historial?</p>
                <p class="text-muted small mb-0">Esta acción es irreversible y eliminará todos los registros, recetas y adjuntos asociados.</p>
            </div>
            <div class="modal-footer border-0 p-4 pt-0 justify-content-center">
                <button type="button" class="btn btn-light rounded-pill px-4 border" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('historial.destroy', $historial->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4 shadow-sm">Sí, Eliminar Historial</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .transition-hover { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .transition-hover:hover { transform: translateY(-3px); box-shadow: var(--shadow-sm); }
</style>
@endpush
@push('scripts')
<script>
    function confirmDelete(event, formId) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede revertir",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'rounded-pill px-4',
                cancelButton: 'rounded-pill px-4'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpush