<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name' => 'cie10_code',
    'id' => 'cie10_code',
    'value' => null,
    'placeholder' => 'Buscar código o diagnóstico...',
    'target' => 'diagnostico_descripcion',
    'required' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'name' => 'cie10_code',
    'id' => 'cie10_code',
    'value' => null,
    'placeholder' => 'Buscar código o diagnóstico...',
    'target' => 'diagnostico_descripcion',
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="cie10-autocomplete-component">
    <div class="input-group">
        <span class="input-group-text bg-primary text-white">
            <i class="fas fa-code"></i>
        </span>
        <input type="text" 
               id="<?php echo e($id); ?>_autocomplete" 
               class="form-control cie10-autocomplete" 
               placeholder="<?php echo e($placeholder); ?>"
               data-target="<?php echo e($target); ?>"
               value="<?php echo e($value ? $value . ' - ' . ($diagnostico ?? '') : ''); ?>"
               <?php echo e($required ? 'required' : ''); ?>>
        <input type="hidden" name="<?php echo e($name); ?>" id="<?php echo e($id); ?>" value="<?php echo e($value); ?>">
        <button type="button" class="btn btn-outline-secondary clear-cie10" title="Limpiar">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <small class="text-muted">Escriba el código o el diagnóstico para buscar automáticamente</small>
</div><?php /**PATH /home/maicol/proyectos/punina-care/resources/views/components/cie10-autocomplete.blade.php ENDPATH**/ ?>