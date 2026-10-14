        <div class="card mb-4 shadow-sm">
        
            <div class="card-header bg-white py-3">
                <i class="fas fa-heartbeat me-2 text-primary"></i> Signos Vitales
                <span class="badge bg-secondary ms-2">La presión Arterial es Obligatoria para mayores de 15 años</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Presión Arterial</label>
                        <input type="text" name="presion_arterial" class="form-control" placeholder="120/80">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">FC (lpm)</label>
                        <input type="text" name="fc" class="form-control" placeholder="75">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Sat O2 (%)</label>
                        <input type="text" name="sat" class="form-control" placeholder="98">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">FR (rpm)</label>
                        <input type="text" name="fr" class="form-control" placeholder="16">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Temperatura (°C)</label>
                        <input type="number" step="0.1" name="temperatura" class="form-control" placeholder="36.5">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Peso (kg)</label>
                        <input type="number" step="0.1" name="peso" id="peso" class="form-control" placeholder="70" onchange="calcularIMC()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Talla (m)</label>
                        <input type="number" step="0.01" name="altura" id="altura" class="form-control" placeholder="1.65" onchange="calcularIMC()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">IMC (Masa Corporal)</label>
                        <input type="text" name="masa_corporal" id="masa_corporal" class="form-control" placeholder="Se calcula automáticamente" readonly>
                    </div>
                </div>
            </div>
        </div>
<?php /**PATH /home/maicol/proyectos/punina-care/resources/views/historial/partials/_signos-vitales.blade.php ENDPATH**/ ?>