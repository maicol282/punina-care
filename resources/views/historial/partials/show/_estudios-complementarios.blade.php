<div class="card shadow-sm mb-3">
    <div class="card-header bg-white">
        <h6 class="mb-0 fw-bold text-primary"><i class="fas fa-microscope me-2"></i>Estudios Complementarios</h6>
    </div>
    <div class="card-body">
        @php
            $categorias = [
                'Laboratorio' => $historial->estudiosAdjuntos->where('categoria', 'Laboratorio'),
                'Imagen' => $historial->estudiosAdjuntos->where('categoria', 'Imagen'),
                'Otros' => $historial->estudiosAdjuntos->where('categoria', 'Otros'),
            ];
            $textos = [
                'Laboratorio' => $historial->laboratorio,
                'Imagen' => $historial->estudio_imagen,
                'Otros' => $historial->otros_exploracion,
            ];
        @endphp

        @foreach($categorias as $nombre => $archivos)
            @if($archivos->count() > 0 || !empty($textos[$nombre]))
                <div class="mb-3">
                    <h6 class="fw-bold text-secondary border-bottom pb-1">{{ $nombre }}</h6>
                    
                    @if(!empty($textos[$nombre]))
                        <p class="small text-muted mb-2">{{ $textos[$nombre] }}</p>
                    @endif

                    @if($archivos->count() > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($archivos as $archivo)
                                <div class="border rounded p-2 d-flex align-items-center bg-light" style="font-size: 12px;">
                                    @if(str_contains($archivo->mime_type, 'image'))
                                        <i class="fas fa-image text-success me-2"></i>
                                    @elseif(str_contains($archivo->mime_type, 'pdf'))
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                    @else
                                        <i class="fas fa-file-alt text-primary me-2"></i>
                                    @endif
                                    
                                    <span class="text-truncate" style="max-width: 150px;" title="{{ $archivo->nombre_original }}">
                                        {{ $archivo->nombre_original }}
                                    </span>
                                    
                                    <a href="{{ Storage::url($archivo->ruta) }}" target="_blank" class="btn btn-sm btn-link text-primary p-0 ms-2" title="Ver archivo">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif
        @endforeach

        @if($historial->estudiosAdjuntos->count() == 0 && empty($historial->laboratorio) && empty($historial->estudio_imagen) && empty($historial->otros_exploracion))
            <p class="text-muted small mb-0">No se registraron estudios complementarios.</p>
        @endif
    </div>
</div>
