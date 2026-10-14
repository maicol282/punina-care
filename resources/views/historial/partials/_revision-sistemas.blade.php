<div class="card mb-4 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-heartbeat me-2 text-primary"></i>
            <span class="fw-semibold">Revisión de Órganos y Sistemas</span>
            <span class="badge bg-secondary ms-2">SP = Sin evidencia patológica | CP = Con evidencia patológica</span>
        </div>
        
    </div>
    <div class="card-body" id="sistemasContainer">
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
                <div class="col-md-6 col-lg-4">
                    <div class="border rounded-3 p-2" style="background: #fafcff;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fas {{ $sistema['icono'] }} text-{{ $sistema['color'] }} me-1"></i>
                            <span class="fw-semibold small">{{ $sistema['label'] }}</span>
                            <div class="btn-group ms-auto" role="group" style="font-size: 11px;">
                                <input type="radio" class="btn-check sistema-radio" 
                                       name="sist_{{ $sistema['id'] }}" 
                                       id="sist_{{ $sistema['id'] }}_sp" 
                                       value="SP" 
                                       data-target="obs_sist_{{ $sistema['id'] }}"
                                       checked>
                                <label class="btn btn-outline-success btn-sm px-2 py-0" for="sist_{{ $sistema['id'] }}_sp">
                                    SP
                                </label>
                                
                                <input type="radio" class="btn-check sistema-radio" 
                                       name="sist_{{ $sistema['id'] }}" 
                                       id="sist_{{ $sistema['id'] }}_cp" 
                                       value="CP"
                                       data-target="obs_sist_{{ $sistema['id'] }}">
                                <label class="btn btn-outline-danger btn-sm px-2 py-0" for="sist_{{ $sistema['id'] }}_cp">
                                    CP
                                </label>
                            </div>
                        </div>
                        <div class="mt-1">
                            <textarea name="sist_{{ $sistema['id'] }}_obs" 
                                      id="obs_sist_{{ $sistema['id'] }}" 
                                      class="form-control form-control-sm sistema-obs" 
                                      rows="1" 
                                      placeholder="Observación..." 
                                      style="display: none; font-size: 12px;"></textarea>
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
                    <textarea name="observaciones_sistemas" class="form-control form-control-sm" rows="2" placeholder="Otras observaciones sobre los sistemas..."></textarea>
                </div>
            </div>
        </div>
