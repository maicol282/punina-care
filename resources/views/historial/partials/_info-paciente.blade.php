    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <i class="fas fa-user-circle fa-2x text-primary me-3"></i>
                    <strong class="fs-5">{{ $paciente->nombre_completo }}</strong>
                    <span class="badge bg-secondary ms-2">{{ $paciente->edad }} años</span>
                    <span class="badge bg-info ms-1">Cédula: {{ $paciente->cedula ?? 'N/A' }}</span>
                    <span class="badge bg-info ms-2" data-bs-toggle="tooltip" title="">
                <i class="fas fa-info-circle"></i> Todos los campos se llenan por defecto si no son llenados por información.
            </span>
                    
                </div>
                <span class="badge bg-light text-dark px-3 py-2 border mt-2 mt-sm-0">{{ $paciente->historialClinicos->count() }} historiales previos</span>
            </div>
            <input type="hidden" id="fecha_nacimiento_paciente" value="{{ $paciente->fecha_nacimiento ?? '' }}">
        </div>
    </div>

    <form action="{{ route('historial.store', $paciente) }}" method="POST">
        @csrf
