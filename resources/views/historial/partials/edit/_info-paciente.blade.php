    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <i class="fas fa-user-circle fa-2x text-primary me-3"></i>
                    <strong class="fs-5">{{ $historial->paciente->nombre_completo }}</strong>
                    <span class="badge bg-secondary ms-2">{{ $historial->paciente->edad }} años</span>
                    <span class="badge bg-info ms-1">Cédula: {{ $historial->paciente->cedula ?? 'N/A' }}</span>
                </div>
                <span class="badge bg-light text-dark px-3 py-2 border mt-2 mt-sm-0">
                    <i class="fas fa-id-card me-1"></i>
                    {{ $historial->paciente->cedula ?? 'SIN-CÉDULA' }}
                    <span class="mx-2">|</span>
                    <i class="far fa-calendar-alt me-1"></i>
                    {{ $historial->fecha_consulta->format('Ymd') }}
                </span>
            </div>
            <input type="hidden" id="fecha_nacimiento_paciente" value="{{ $paciente->fecha_nacimiento ?? '' }}">
        </div>
    </div>
