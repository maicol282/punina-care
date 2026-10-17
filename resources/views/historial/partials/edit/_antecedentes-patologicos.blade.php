        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-notes-medical me-2 text-primary"></i> Antecedentes Personales Patológicos
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🏥 Hospitalizaciones</label>
                        <textarea name="hospitalizaciones" class="form-control" rows="2" placeholder="Describa hospitalizaciones previas...">{{ old('hospitalizaciones', $historial->hospitalizaciones) }}</textarea>
                    </div>

                    @php $hasCV = old('cardiovasculares', $historial->cardiovasculares); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_cardiovasculares" data-target="cardiovasculares" {{ $hasCV ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_cardiovasculares">❤️ Cardiovasculares</label>
                                </div>
                                <textarea name="cardiovasculares" id="cardiovasculares" class="form-control mt-2 campo-patologico" style="display: {{ $hasCV ? 'block' : 'none' }};" rows="2" placeholder="Hipertensión, arritmias...">{{ old('cardiovasculares', $historial->cardiovasculares) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasPul = old('pulmonales', $historial->pulmonales); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_pulmonales" data-target="pulmonales" {{ $hasPul ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_pulmonales">🫁 Pulmonares</label>
                                </div>
                                <textarea name="pulmonales" id="pulmonales" class="form-control mt-2 campo-patologico" style="display: {{ $hasPul ? 'block' : 'none' }};" rows="2" placeholder="Asma, EPOC, bronquitis...">{{ old('pulmonales', $historial->pulmonales) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasDig = old('digestivos', $historial->digestivos); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_digestivos" data-target="digestivos" {{ $hasDig ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_digestivos">🍽️ Digestivos</label>
                                </div>
                                <textarea name="digestivos" id="digestivos" class="form-control mt-2 campo-patologico" style="display: {{ $hasDig ? 'block' : 'none' }};" rows="2" placeholder="Gastritis, colitis...">{{ old('digestivos', $historial->digestivos) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasDia = old('diabetes', $historial->diabetes); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_diabetes" data-target="diabetes" {{ $hasDia ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_diabetes">🩸 Diabetes</label>
                                </div>
                                <textarea name="diabetes" id="diabetes" class="form-control mt-2 campo-patologico" style="display: {{ $hasDia ? 'block' : 'none' }};" rows="2" placeholder="Tipo, tiempo...">{{ old('diabetes', $historial->diabetes) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @php $hasRen = old('renales', $historial->renales); @endphp
                    <div class="col-md-6">
                        <div class="card border">
                            <div class="card-body py-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggle-patologico" type="checkbox" id="toggle_renales" data-target="renales" {{ $hasRen ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="toggle_renales">💧 Renales</label>
                                </div>
                                <textarea name="renales" id="renales" class="form-control mt-2 campo-patologico" style="display: {{ $hasRen ? 'block' : 'none' }};" rows="2" placeholder="Insuficiencia renal...">{{ old('renales', $historial->renales) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🔪 Quirúrgicos</label>
                        <textarea name="quirurgicos" class="form-control" rows="2" placeholder="Cirugías previas...">{{ old('quirurgicos', $historial->quirurgicos) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">🩸 Transfusiones</label>
                        <textarea name="transfusiones" class="form-control" rows="2" placeholder="Número, fechas...">{{ old('transfusiones', $historial->transfusiones) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">⚠️ Alergias a medicamentos</label>
                        <textarea name="alergias_patologicas" class="form-control" rows="2" placeholder="Penicilina, Ibuprofeno...">{{ old('alergias_patologicas', $historial->alergias_patologicas) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">📋 Otros Patológicos</label>
                        <textarea name="otros_patologicos" class="form-control" rows="2" placeholder="Otras condiciones...">{{ old('otros_patologicos', $historial->otros_patologicos) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
