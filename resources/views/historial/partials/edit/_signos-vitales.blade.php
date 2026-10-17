        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-heartbeat me-2 text-primary"></i> Signos Vitales
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Presión Arterial</label>
                        <input type="text" name="presion_arterial" class="form-control" placeholder="120/80" value="{{ old('presion_arterial', $historial->presion_arterial) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">FC (lpm)</label>
                        <input type="text" name="fc" class="form-control" placeholder="75" value="{{ old('fc', $historial->fc) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Sat O2 (%)</label>
                        <input type="text" name="sat" class="form-control" placeholder="98" value="{{ old('sat', $historial->sat) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">FR (rpm)</label>
                        <input type="text" name="fr" class="form-control" placeholder="16" value="{{ old('fr', $historial->fr) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Temperatura (°C)</label>
                        <input type="number" step="0.1" name="temperatura" class="form-control" placeholder="36.5" value="{{ old('temperatura', $historial->temperatura) }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Peso (kg)</label>
                        <input type="number" step="0.1" name="peso" id="peso" class="form-control" placeholder="70" value="{{ old('peso', $historial->peso) }}" onchange="calcularIMC()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Talla (m)</label>
                        <input type="number" step="0.01" name="altura" id="altura" class="form-control" placeholder="1.65" value="{{ old('altura', $historial->altura) }}" onchange="calcularIMC()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">IMC (Masa Corporal)</label>
                        <input type="text" name="masa_corporal" id="masa_corporal" class="form-control" placeholder="Se calcula automáticamente" readonly value="{{ old('masa_corporal', $historial->masa_corporal) }}">
                    </div>
                </div>
            </div>
        </div>
