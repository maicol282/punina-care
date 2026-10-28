<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use LSNepomuceno\Signet\Signet;

class PdfSignerService
{
    /**
     * Firma un PDF usando el certificado del médico logueado.
     * Devuelve el contenido del PDF (firmado o sin firmar si falla).
     */
    public function firmar(string $pdfContent): string
    {
        $medico = auth()->user();

        if (!$medico || !$medico->certificado_p12 || !$medico->certificado_password) {
            return $pdfContent; // Si no hay certificado, devolvemos el PDF sin firmar
        }

        try {
            $p12Path = Storage::disk('local')->path($medico->certificado_p12);

            if (!file_exists($p12Path)) {
                return $pdfContent;
            }

            // Guardar temporalmente
            $tempPath = storage_path('app/temp_' . uniqid() . '.pdf');
            file_put_contents($tempPath, $pdfContent);

            // Firmar con Signet
            $signet = new Signet();
            $signet->newSignature()
                ->certificate($p12Path, $medico->certificado_password)
                ->pdf($tempPath)
                ->sign();

            // Leer el PDF firmado
            $firmado = file_get_contents($tempPath);
            unlink($tempPath);

            return $firmado;
        } catch (\Exception $e) {
            Log::warning('No se pudo firmar el PDF: ' . $e->getMessage());
            return $pdfContent; // Si falla, devolvemos el original
        }
    }
}
