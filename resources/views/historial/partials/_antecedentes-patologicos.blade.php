        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-notes-medical me-2 text-primary"></i> Antecedentes Personales Patológicos
                <span class="badge bg-secondary ms-2">Haga clic en el interruptor para activar cada sección</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Siempre visibles -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🏥 Hospitalizaciones</label>
                        <textarea name="hospitalizaciones" class="form-control" rows="2" placeholder="Describa hospitalizaciones previas..."></textarea>
                    </div>

                    <!-- Toggle: Cardiovasculares -->
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_cardiovasculares" data-target="cardiovasculares">
                                    <label class="form-check-label fw-semibold" for="toggle_cardiovasculares">❤️ Cardiovasculares</label>
                                </div>
                                <textarea name="cardiovasculares" id="cardiovasculares" class="form-control mt-2 campo-patologico" style="display: none;" rows="2" placeholder="Hipertensión, arritmias..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Toggle: Pulmonares -->
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_pulmonales" data-target="pulmonales">
                                    <label class="form-check-label fw-semibold" for="toggle_pulmonales">🫁 Pulmonares</label>
                                </div>
                                <textarea name="pulmonales" id="pulmonales" class="form-control mt-2 campo-patologico" style="display: none;" rows="2" placeholder="Asma, EPOC, bronquitis..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Toggle: Digestivos -->
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_digestivos" data-target="digestivos">
                                    <label class="form-check-label fw-semibold" for="toggle_digestivos">🍽️ Digestivos</label>
                                </div>
                                <textarea name="digestivos" id="digestivos" class="form-control mt-2 campo-patologico" style="display: none;" rows="2" placeholder="Gastritis, colitis..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Toggle: Diabetes -->
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_diabetes" data-target="diabetes">
                                    <label class="form-check-label fw-semibold" for="toggle_diabetes">🩸 Diabetes</label>
                                </div>
                                <textarea name="diabetes" id="diabetes" class="form-control mt-2 campo-patologico" style="display: none;" rows="2" placeholder="Tipo, tiempo..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Toggle: Renales -->
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_renales" data-target="renales">
                                    <label class="form-check-label fw-semibold" for="toggle_renales">💧 Renales</label>
                                </div>
                                <textarea name="renales" id="renales" class="form-control mt-2 campo-patologico" style="display: none;" rows="2" placeholder="Insuficiencia renal..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Siempre visibles -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🔪 Quirúrgicos</label>
                        <textarea name="quirurgicos" class="form-control" rows="2" placeholder="Cirugías previas..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🩸 Transfusiones</label>
                        <textarea name="transfusiones" class="form-control" rows="2" placeholder="Número, fechas..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">⚠️ Alergias a medicamentos</label>
                        <textarea name="alergias_patologicas" class="form-control" rows="2" placeholder="Penicilina, Ibuprofeno..."></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">📋 Otros Patológicos</label>
                        <textarea name="otros_patologicos" class="form-control" rows="2" placeholder="Otras condiciones..."></textarea>
                    </div>
                </div>
            </div>
        </div>
