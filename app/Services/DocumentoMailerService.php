<?php

namespace App\Services;

use App\Mail\DocumentoMedicoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class DocumentoMailerService
{
    public function enviar($documento, string $tipo, string $vistaPdf): array
    {
        try {
            // Obtener el paciente (la relación debe existir en el modelo)
            $paciente = $documento->paciente ?? null;
            
            if (!$paciente) {
                return ['success' => false, 'message' => 'No se encontró el paciente asociado al documento.'];
            }

            // Obtener el email (el trait Encryptable lo desencripta automáticamente)
            $emailPaciente = trim((string) $paciente->email);
            
            // Log para diagnóstico (revisar en storage/logs/laravel.log)
            Log::info("Intento de envío a: [{$emailPaciente}] para paciente ID: {$paciente->id}");

            if (empty($emailPaciente) || !filter_var($emailPaciente, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'El paciente no tiene un correo electrónico válido registrado. (Valor leído: "' . $emailPaciente . '")'];
            }

            // Generar el PDF
            // (Pasamos las variables comunes para que funcione en cualquier vista)
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($vistaPdf, [
                'documento' => $documento, 
                'pedido' => $documento, 
                'receta' => $documento,
                'certificado' => $documento,
                'reposo' => $documento,
            ]);
            $pdfContent = $pdf->output();

            // Enviar correo
            Mail::to($emailPaciente)->send(new DocumentoMedicoMail($paciente, $tipo, $pdfContent));

            // Actualizar trazabilidad
            if (Schema::hasColumn($documento->getTable(), 'enviado')) {
                $documento->update(['enviado' => true, 'fecha_envio' => now()]);
            }

            return ['success' => true, 'message' => 'Documento enviado correctamente a ' . $emailPaciente];
            
        } catch (\Exception $e) {
            Log::error('Error al enviar documento: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Error al enviar: ' . $e->getMessage()];
     
        }
            // Intentar obtener el paciente de varias formas
            $paciente = $documento->paciente ?? null;
            
            // Si la receta tiene historial clínico, obtener el paciente de ahí
            if (!$paciente && isset($documento->historial_clinico_id)) {
                $historial = \App\Models\HistorialClinico::find($documento->historial_clinico_id);
                $paciente = $historial?->paciente;
            }
            
            // Si aún no se encuentra, intentar por ID directo (si existe la columna)
            if (!$paciente && isset($documento->paciente_id)) {
                $paciente = \App\Models\Paciente::find($documento->paciente_id);
            }

            if (!$paciente) {
                return ['success' => false, 'message' => 'No se encontró el paciente asociado al documento.'];
            }

    }
}