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
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            Este historial tiene {{ $historial->recetas->count() }} receta(s) asociada(s). 
            Para modificarlas, haga clic en "Gestionar Recetas".
        </div>
        <ul class="list-group">
            @foreach($historial->recetas as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Receta #{{ $receta->id }}</strong> - {{ $receta->fecha_emision->format('d/m/Y') }}
                        @php
                            $meds = $receta->medicamentos_json ? json_decode($receta->medicamentos_json, true) : [];
                        @endphp
                        <span class="badge bg-secondary ms-2">{{ count($meds) }} medicamentos</span>
                    </div>
                    <div>
                        <a href="{{ route('recetas.edit', $receta) }}" class="btn btn-sm btn-warning text-dark">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
