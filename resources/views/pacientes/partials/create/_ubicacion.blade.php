<div class="card mb-3">
    <div class="card-header bg-white">
        <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2 text-primary"></i>Ubicación</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="pais" class="form-label">País</label>
                <input type="text" class="form-control @error('pais') is-invalid @enderror" 
                       id="pais" name="pais" value="{{ old('pais') }}" placeholder="Ecuador">
                @error('pais')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="provincia" class="form-label">Provincia</label>
                <input type="text" class="form-control @error('provincia') is-invalid @enderror" 
                       id="provincia" name="provincia" value="{{ old('provincia') }}" placeholder="Pichincha">
                @error('provincia')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <input type="text" class="form-control @error('ciudad') is-invalid @enderror" 
                       id="ciudad" name="ciudad" value="{{ old('ciudad') }}" placeholder="Quito">
                @error('ciudad')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-12 mb-3">
                <label for="direccion" class="form-label">Dirección específica</label>
                <textarea class="form-control @error('direccion') is-invalid @enderror" 
                          id="direccion" name="direccion" rows="2" 
                          placeholder="Calle, número, edificio...">{{ old('direccion') }}</textarea>
                @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
