    <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
        <div class="card-body p-4" style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%); color: white;">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-user-injured fa-2x text-white"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-1">{{ $historial->paciente->nombre_completo }}</h4>
                        <div class="d-flex flex-wrap gap-2 align-items-center" style="font-size: 13px;">
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-id-card me-1"></i> {{ $historial->paciente->cedula ?? 'S/C' }}</span>
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-birthday-cake me-1"></i> {{ $historial->paciente->edad }} años</span>
                            <span class="bg-white bg-opacity-25 px-2 py-1 rounded"><i class="fas fa-phone me-1"></i> {{ $historial->paciente->telefono ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="badge bg-white text-primary px-3 py-2 rounded-pill fs-6 mb-1 shadow-sm">
                        <i class="fas fa-id-card me-2"></i>
                        {{ $historial->paciente->cedula ?? 'SIN-CÉDULA' }}
                        <span class="mx-2">|</span>
                        <i class="far fa-calendar-alt me-1"></i>
                        {{ $historial->fecha_consulta->format('Ymd') }}
                    </div>
                    <div class="text-white-50 small"><i class="far fa-calendar-alt me-1"></i> {{ $historial->fecha_consulta->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
    </div>
