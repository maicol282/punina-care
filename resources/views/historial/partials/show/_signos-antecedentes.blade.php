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
