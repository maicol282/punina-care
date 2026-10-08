$(document).ready(function() {
    // ============================================
    // AUTOCOMPLETADO CIE-10
    // ============================================
    $('.cie10-autocomplete').each(function() {
        const input = $(this);
        const hiddenId = input.data('target');
        const hiddenInput = $('#' + hiddenId);
        const codeInput = input.closest('.cie10-autocomplete-component').find('input[type="hidden"]');
        const clearBtn = input.closest('.input-group').find('.clear-cie10');

        // Configurar autocompletado
        input.autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '{{ route("cie10.autocomplete") }}',
                    data: {
                        term: request.term
                    },
                    dataType: 'json',
                    success: function(data) {
                        response(data);
                    },
                    error: function() {
                        response([]);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                // Cuando se selecciona un elemento
                const item = ui.item;
                input.val(item.label);
                codeInput.val(item.value);
                
                // Si hay un campo de diagnóstico destino, llenarlo
                if (hiddenInput.length) {
                    hiddenInput.val(item.diagnostico);
                }
                
                // Disparar evento change
                input.trigger('change');
                
                return false;
            },
            focus: function(event, ui) {
                // Mostrar el diagnóstico en el tooltip
                input.attr('title', ui.item.diagnostico);
                return false;
            }
        })
        // Personalizar la renderización de los resultados
        .data('ui-autocomplete')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div><strong>' + item.value + '</strong> - ' + item.diagnostico + '</div>')
                .appendTo(ul);
        };

        // ============================================
        // BÚSQUEDA BIDIRECCIONAL: Diagnóstico -> Código
        // ============================================
        if (hiddenInput.length) {
            let typingTimer;
            const doneTypingInterval = 500;

            hiddenInput.on('input', function() {
                const diagnostico = $(this).val();
                
                clearTimeout(typingTimer);
                
                if (diagnostico.length < 3) {
                    return;
                }

                typingTimer = setTimeout(function() {
                    $.ajax({
                        url: '{{ route("cie10.by-diagnostico") }}',
                        data: {
                            diagnostico: diagnostico
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data && data.codigo) {
                                codeInput.val(data.codigo);
                                input.val(data.codigo + ' - ' + data.diagnostico);
                            }
                        }
                    });
                }, doneTypingInterval);
            });

            // ============================================
            // BÚSQUEDA BIDIRECCIONAL: Código -> Diagnóstico
            // ============================================
            codeInput.on('change', function() {
                const codigo = $(this).val();
                if (codigo && codigo.length >= 2) {
                    $.ajax({
                        url: '{{ route("cie10.get") }}'.replace('{codigo}', codigo),
                        dataType: 'json',
                        success: function(data) {
                            if (data.success) {
                                hiddenInput.val(data.diagnostico);
                                input.val(data.codigo + ' - ' + data.diagnostico);
                            }
                        }
                    });
                }
            });
        }

        // ============================================
        // BOTÓN LIMPIAR
        // ============================================
        if (clearBtn.length) {
            clearBtn.on('click', function() {
                input.val('');
                codeInput.val('');
                if (hiddenInput.length) {
                    hiddenInput.val('');
                }
                input.focus();
            });
        }

        // ============================================
        // AUTOCOMPLETAR AL PERDER EL FOCO (SI TIENE CÓDIGO)
        // ============================================
        input.on('blur', function() {
            const val = $(this).val();
            // Si el valor parece un código (sin guión)
            if (val && !val.includes(' - ') && val.length >= 2) {
                const cleanCode = val.replace('.', '');
                $.ajax({
                    url: '{{ route("cie10.get") }}'.replace('{codigo}', cleanCode),
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            input.val(data.codigo + ' - ' + data.diagnostico);
                            codeInput.val(data.codigo);
                            if (hiddenInput.length) {
                                hiddenInput.val(data.diagnostico);
                            }
                        }
                    }
                });
            }
        });
    });
});