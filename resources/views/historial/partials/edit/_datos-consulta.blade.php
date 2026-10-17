        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-white py-3">
                <i class="fas fa-notes-medical me-2 text-primary"></i> Datos de la Consulta
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Fecha Consulta <span class="text-danger">*</span></label>
                        <input type="date" name="fecha_consulta" class="form-control" value="{{ old('fecha_consulta', $historial->fecha_consulta->format('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Doctor Responsable</label>
                        <select name="doctor" class="form-select">
                            <option value="">Seleccione un médico</option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->name }}" {{ old('doctor', $historial->doctor) == $medico->name ? 'selected' : '' }}>
                                    {{ $medico->name }} @if($medico->especialidad) - {{ $medico->especialidad }} @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Motivo de Consulta <span class="text-danger">*</span></label>
                        <textarea name="motivo_consulta" class="form-control" rows="2" placeholder="Describa el motivo..." required>{{ old('motivo_consulta', $historial->motivo_consulta) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
