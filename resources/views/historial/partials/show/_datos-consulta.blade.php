    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
            <h6 class="fw-bold text-dark d-flex align-items-center mb-0">
                <span class="icon-box bg-primary bg-opacity-10 text-primary rounded-3 me-2" style="width: 32px; height: 32px;"><i class="fas fa-stethoscope"></i></span>
                Datos de la Consulta
            </h6>
        </div>
        <div class="card-body p-4">
            <div class="row g-4">
                <div class="col-md-3">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Fecha</span>
                    <span class="text-dark fw-medium">{{ $historial->fecha_consulta->format('d/m/Y') }}</span>
                </div>
                <div class="col-md-3">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Doctor Responsable</span>
                    <span class="text-dark fw-medium"><i class="fas fa-user-md text-primary me-1"></i> {{ $historial->doctor ?? 'No registrado' }}</span>
                </div>
                <div class="col-md-6">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Motivo de Consulta</span>
                    <div class="p-3 bg-light rounded-3 text-dark border">{{ $historial->motivo_consulta ?? 'No registrado' }}</div>
                </div>
                <div class="col-12 mt-4">
                    <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="letter-spacing: 0.5px;">Enfermedad Actual</span>
                    <p class="text-dark mb-0 lh-lg">{{ $historial->enfermedad_actual ?? 'No registra' }}</p>
                </div>
            </div>
        </div>
    </div>
