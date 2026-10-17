        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-stethoscope me-2 text-primary"></i> Enfermedad Actual
            </div>
            <div class="card-body">
                <textarea name="enfermedad_actual" class="form-control" rows="3" placeholder="Describa la enfermedad actual, síntomas, evolución...">{{ old('enfermedad_actual', $historial->enfermedad_actual) }}</textarea>
            </div>
        </div>
