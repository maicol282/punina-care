<div class="card mb-3">
    <div class="card-header bg-white">
        <h6 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>Información Personal</h6>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('apellido') is-invalid @enderror" 
                   id="apellido" name="apellido" value="{{ old('apellido') }}" required>
            @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento <span class="text-danger">*</span></label>
                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                       id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                @error('fecha_nacimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="edad" class="form-label">Edad (años)</label>
                <input type="text" class="form-control" id="edad" readonly style="background-color: #e9ecef;">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="genero" class="form-label">Género <span class="text-danger">*</span></label>
                <select class="form-select @error('genero') is-invalid @enderror" id="genero" name="genero" required>
                    <option value="">Seleccione...</option>
                    <option value="M" {{ old('genero') == 'M' ? 'selected' : '' }}>Masculino</option>
                    <option value="F" {{ old('genero') == 'F' ? 'selected' : '' }}>Femenino</option>
                    <option value="Otro" {{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('genero')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="tipo_sangre" class="form-label">Tipo de Sangre</label>
                <select class="form-select @error('tipo_sangre') is-invalid @enderror" id="tipo_sangre" name="tipo_sangre">
                    <option value="">Seleccione...</option>
                    @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $tipo)
                        <option value="{{ $tipo }}" {{ old('tipo_sangre') == $tipo ? 'selected' : '' }}>{{ $tipo }}</option>
                    @endforeach
                </select>
                @error('tipo_sangre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                       id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cedula" class="form-label">Cédula</label>
                <input type="text" class="form-control @error('cedula') is-invalid @enderror" 
                       id="cedula" name="cedula" value="{{ old('cedula') }}" 
                       placeholder="1234567890" maxlength="10" 
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                @error('cedula')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="ocupacion" class="form-label">Ocupación</label>
                <input type="text" class="form-control @error('ocupacion') is-invalid @enderror" 
                       id="ocupacion" name="ocupacion" value="{{ old('ocupacion') }}" 
                       placeholder="Ej: Médico, Ingeniero...">
                @error('ocupacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
