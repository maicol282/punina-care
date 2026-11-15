<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertirMayusculas
{
    /**
     * Campos que NO deben convertirse a mayúsculas (por lógica).
     */
    protected $except = [
        'password',
        'password_confirmation',
        'current_password',
        '_token',
        '_method',
        'email',                    // Emails en minúsculas (estándar)
        'certificado_password',     // Contraseña del certificado
        'ruta',                     // Rutas de archivos
        'nombre_guardado',          // Nombres de archivos guardados
        'mime_type',                // Tipo MIME
        'extension',                // Extensiones
        'archivo',                  // Archivos subidos
        'archivos_laboratorio',     // Archivos (no son texto)
        'archivos_imagen',
        'archivos_otros',
        'firma',                    // Firma digital (archivo)
        'certificado',              // Certificado (archivo)
        'logo',                     // Logos
        'avatar',                   // Avatares
        'timestamp',                // Timestamp encriptado (login)
        'g-recaptcha-response',     // Captcha
        'website',                  // Honeypot
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('PATCH')) {
            $input = $request->all();
            $input = $this->convertirMayusculas($input);
            $request->merge($input);
        }

        return $next($request);
    }

    protected function convertirMayusculas(array $data): array
    {
        foreach ($data as $key => $value) {
            // Si es un array (como los medicamentos en JSON), recorrer recursivamente
            if (is_array($value)) {
                $data[$key] = $this->convertirMayusculas($value);
            } 
            // Si es string y no está en la lista de excepciones, convertir
            elseif (is_string($value) && !in_array($key, $this->except)) {
                $data[$key] = mb_strtoupper($value, 'UTF-8');
            }
        }
        return $data;
    }
}
