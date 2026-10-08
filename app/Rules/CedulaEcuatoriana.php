<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CedulaEcuatoriana implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Algoritmo de validación de cédula ecuatoriana
        if (!$this->validarCedula($value)) {
            $fail('La cédula ingresada no es válida.');
        }
    }
    
    private function validarCedula($cedula)
    {
        if (strlen($cedula) != 10) return false;
        if (!is_numeric($cedula)) return false;
        
        $digito_region = substr($cedula, 0, 2);
        if ($digito_region < 1 || $digito_region > 24) return false;
        
        $ultimo_digito = substr($cedula, -1);
        $pares = 0;
        $impares = 0;
        
        for ($i = 0; $i < 9; $i++) {
            if ($i % 2 == 0) {
                $impares += substr($cedula, $i, 1);
            } else {
                $pares += substr($cedula, $i, 1);
            }
        }
        
        $suma = ($impares * 2) + $pares;
        $decena = ceil($suma / 10) * 10;
        $digito_verificador = $decena - $suma;
        
        if ($digito_verificador == 10) $digito_verificador = 0;
        
        return $digito_verificador == $ultimo_digito;
    }
}