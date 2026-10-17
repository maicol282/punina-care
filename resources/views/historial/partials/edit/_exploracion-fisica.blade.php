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
