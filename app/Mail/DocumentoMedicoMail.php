<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class DocumentoMedicoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $paciente;
    public $tipoDocumento;
    public $pdfContent;
    public $asunto;

    public function __construct($paciente, string $tipoDocumento, $pdfContent = null, ?string $asunto = null)
    {
        $this->paciente = $paciente;
        $this->tipoDocumento = $tipoDocumento;
        $this->pdfContent = $pdfContent;
        $this->asunto = $asunto ?? $this->generarAsunto();
    }

    protected function generarAsunto(): string
    {
        return match($this->tipoDocumento) {
            'receta' => 'Receta Médica - Punina Care',
            'certificado' => 'Certificado Médico - Punina Care',
            'examen' => 'Pedido de Exámenes - Punina Care',
            default => 'Documento Médico - Punina Care',
        };
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->asunto);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.documento-medico');
    }

    public function attachments(): array
    {
        if ($this->pdfContent) {
            $filename = match($this->tipoDocumento) {
                'receta' => 'receta-medica.pdf',
                'certificado' => 'certificado-medico.pdf',
                'examen' => 'pedido-examenes.pdf',
                default => 'documento.pdf',
            };
            return [
                Attachment::fromData(fn () => $this->pdfContent, $filename)->withMime('application/pdf'),
            ];
        }
        return [];
    }
}