<div class="card mb-3">
    <div class="card-header bg-white">
        <h6 class="mb-0"><i class="fas fa-notes-medical me-2 text-primary"></i>Información Médica</h6>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="alergias" class="form-label">
                <i class="fas fa-allergies me-1 text-danger"></i> Alergias
            </label>
            <textarea class="form-control @error('alergias') is-invalid @enderror" 
                      id="alergias" name="alergias" rows="3" 
                      placeholder="Ej: Penicilina, Ibuprofeno, látex, polen, etc...">{{ old('alergias') }}</textarea>
            @error('alergias')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones</label>
            <textarea class="form-control @error('observaciones') is-invalid @enderror" 
                      id="observaciones" name="observaciones" rows="3" 
                      placeholder="Información adicional relevante...">{{ old('observaciones') }}</textarea>
            @error('observaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
