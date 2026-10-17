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
