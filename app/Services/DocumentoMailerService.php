<?php

namespace App\Services;

use App\Mail\DocumentoMedicoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use LSNepomuceno\Signet\Signet;

class DocumentoMailerService
{
    public function enviar($documento, string $tipo, string $vistaPdf): array
    {
        try {
            $paciente = $documento->paciente ?? null;
            
            if (!$paciente && isset($documento->historial_clinico_id)) {
                $historial = \App\Models\HistorialClinico::find($documento->historial_clinico_id);
                $paciente = $historial?->paciente;
            }
            
            if (!$paciente && isset($documento->paciente_id)) {
                $paciente = \App\Models\Paciente::find($documento->paciente_id);
            }

            if (!$paciente) {
                return ['success' => false, 'message' => 'No se encontró el paciente asociado al documento.'];
            }

            $emailPaciente = trim((string) $paciente->email);
            
            if (empty($emailPaciente) || !filter_var($emailPaciente, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'El paciente no tiene un correo electrónico válido registrado.'];
            }

            // Generar el PDF
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView($vistaPdf, [
                'documento' => $documento, 
                'pedido' => $documento, 
                'receta' => $documento,
                'certificado' => $documento,
                'reposo' => $documento,
            ]);
            $pdfContent = $pdf->output();

            // ============================================
            // FIRMA DIGITAL (si el médico tiene certificado)
            // ============================================
            $medico = auth()->user(); // El médico que está logueado
            if ($medico && $medico->certificado_p12 && $medico->certificado_password) {
                try {
                    $p12Path = Storage::disk('local')->path($medico->certificado_p12);
                    
                    if (file_exists($p12Path)) {
                        // Guardar temporalmente el PDF sin firma
                        $tempPath = storage_path('app/temp_' . uniqid() . '.pdf');
                        file_put_contents($tempPath, $pdfContent);

                        // Firmar con Signet
                        $signet = new Signet();
                        $signet->newSignature()
                            ->certificate($p12Path, $medico->certificado_password)
                            ->pdf($tempPath)
                            ->sign();

                        // Leer el PDF firmado
                        $pdfContent = file_get_contents($tempPath);
                        
                        // Limpiar archivo temporal
                        unlink($tempPath);
                    }
                } catch (\Exception $e) {
                    Log::warning('No se pudo firmar el PDF: ' . $e->getMessage());
                    // Continuamos enviando el PDF sin firmar si falla
                }
            }

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
    }
}