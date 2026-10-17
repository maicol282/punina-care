        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-pills me-2 text-primary"></i> Tratamiento y Recomendaciones
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Tratamiento</label>
                    <textarea name="tratamiento" class="form-control" rows="3" placeholder="Indicaciones médicas, medicamentos, procedimientos...">{{ old('tratamiento', $historial->tratamiento) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Recomendaciones</label>
                    <textarea name="recomendaciones" class="form-control" rows="3" placeholder="Recomendaciones para el paciente...">{{ old('recomendaciones', $historial->recomendaciones) }}</textarea>
                </div>
            </div>
        </div>
