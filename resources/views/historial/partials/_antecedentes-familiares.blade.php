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
                                <input class="form-check-input familiar-checkbox" type="checkbox" name="{{ $key }}" id="{{ $key }}" value="1">
                                <label class="form-check-label" for="{{ $key }}">{{ $label }}</label>
                            </div>
                        </div>
                    @endforeach
                    
                    <div class="col-md-12 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="familiares_no_refiere" id="familiares_no_refiere" value="1">
                            <label class="form-check-label text-muted" for="familiares_no_refiere">No refiere antecedentes familiares</label>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Observaciones de Antecedentes Familiares</label>
                        <textarea name="antecedentes_familiares" class="form-control" rows="2" placeholder="Detalle adicional de antecedentes familiares..."></textarea>
                    </div>
                </div>
            </div>
        </div>
