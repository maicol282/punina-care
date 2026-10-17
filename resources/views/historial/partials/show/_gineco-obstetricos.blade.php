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
