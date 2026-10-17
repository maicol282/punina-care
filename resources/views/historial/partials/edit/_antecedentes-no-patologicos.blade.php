        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-heartbeat me-2 text-primary"></i> Antecedentes Personales No Patológicos
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🍺 Alcohol</label>
                        <textarea name="alcohol" class="form-control" rows="2" placeholder="Frecuencia, cantidad...">{{ old('alcohol', $historial->alcohol) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🚬 Tabaquismo</label>
                        <textarea name="tabaquismo" class="form-control" rows="2" placeholder="Cigarrillos/día...">{{ old('tabaquismo', $historial->tabaquismo) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">💊 Drogas</label>
                        <textarea name="drogas" class="form-control" rows="2" placeholder="Tipo, frecuencia...">{{ old('drogas', $historial->drogas) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">💉 Inmunizaciones</label>
                        <textarea name="inmunizaciones" class="form-control" rows="2" placeholder="Vacunas, fechas...">{{ old('inmunizaciones', $historial->inmunizaciones) }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">📝 Otros No Patológicos</label>
                        <textarea name="otros_no_patologicos" class="form-control" rows="2" placeholder="Ejercicio, alimentación...">{{ old('otros_no_patologicos', $historial->otros_no_patologicos) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
