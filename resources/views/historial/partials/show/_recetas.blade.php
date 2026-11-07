@if($historial->recetas && $historial->recetas->count() > 0)
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
            <span class="icon-box bg-success bg-opacity-10 text-success rounded-3 me-2" style="width: 32px; height: 32px;">
                <i class="fas fa-prescription-bottle-alt"></i>
            </span>
            Recetas Médicas ({{ $historial->recetas->count() }})
        </h6>
        <a href="{{ route('recetas.index', $historial->id) }}" class="btn btn-sm btn-outline-success">
            <i class="fas fa-plus me-1"></i> Gestionar Recetas
        </a>
    </div>
    <div class="card-body p-4">
        <div class="row g-3">
            @foreach($historial->recetas as $receta)
                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <strong class="text-dark">Receta #{{ $receta->id }}</strong>
                            <span class="badge bg-secondary">{{ $receta->fecha_emision->format('d/m/Y') }}</span>
                        </div>
                        
                        @php
                            $medicamentos = $receta->medicamentos_json ? json_decode($receta->medicamentos_json, true) : [];
                        @endphp
                        
                        @if(count($medicamentos) > 0)
                            <ul class="list-unstyled mb-2 small">
                                @foreach($medicamentos as $med)
                                    <li class="mb-1">
                                        <i class="fas fa-pills text-success me-1"></i>
                                        <strong>{{ $med['medicamento'] ?? '' }}</strong>
                                        @if(!empty($med['dosis']))
                                            - {{ $med['dosis'] }}
                                        @endif
                                        @if(!empty($med['frecuencia']))
                                            - {{ $med['frecuencia'] }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="small text-muted mb-2">{{ $receta->medicamento ?? 'Sin medicamentos registrados' }}</p>
                        @endif
                        
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('recetas.imprimir', $receta->id) }}" target="_blank" class="btn btn-sm btn-danger text-white">
                                <i class="fas fa-file-pdf me-1"></i> PDF
                            </a>
                            <a href="{{ route('recetas.enviar', $receta) }}" class="btn btn-sm btn-info text-white" onclick="return confirm('¿Enviar receta al paciente?')">
                                <i class="fas fa-envelope me-1"></i> Enviar
                            </a>
                            <a href="{{ route('recetas.edit', $receta) }}" class="btn btn-sm btn-warning text-dark">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
