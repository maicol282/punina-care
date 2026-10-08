@props([
    'name' => 'cie10_code',
    'id' => 'cie10_code',
    'value' => null,
    'placeholder' => 'Buscar código o diagnóstico...',
    'target' => 'diagnostico_descripcion',
    'required' => false,
])

<div class="cie10-autocomplete-component">
    <div class="input-group">
        <span class="input-group-text bg-primary text-white">
            <i class="fas fa-code"></i>
        </span>
        <input type="text" 
               id="{{ $id }}_autocomplete" 
               class="form-control cie10-autocomplete" 
               placeholder="{{ $placeholder }}"
               data-target="{{ $target }}"
               value="{{ $value ? $value . ' - ' . ($diagnostico ?? '') : '' }}"
               {{ $required ? 'required' : '' }}>
        <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}">
        <button type="button" class="btn btn-outline-secondary clear-cie10" title="Limpiar">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <small class="text-muted">Escriba el código o el diagnóstico para buscar automáticamente</small>
</div>