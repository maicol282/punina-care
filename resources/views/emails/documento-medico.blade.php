<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Documento Médico</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .header { background: #0d6efd; color: white; padding: 20px; text-align: center; }
        .header h2 { margin: 0; }
        .content { padding: 30px; color: #333; line-height: 1.6; }
        .footer { background: #f8f9fa; text-align: center; padding: 15px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🏥 Punina Care</h2>
            <p>Tu salud, nuestra prioridad</p>
        </div>
        <div class="content">
            <h3>Hola, {{ $paciente->nombre_completo }}</h3>
            <p>Te informamos que se ha emitido el siguiente documento médico:</p>
            <p style="font-size: 18px; font-weight: bold; color: #0d6efd;">
                @if($tipoDocumento === 'receta') 📄 Receta Médica
                @elseif($tipoDocumento === 'certificado') 📋 Certificado Médico
                @elseif($tipoDocumento === 'examen') 🔬 Pedido de Exámenes
                @endif
            </p>
            <p>Adjunto a este correo encontrarás el documento en formato PDF. Por favor, revísalo y sigue las indicaciones correspondientes.</p>
            <div style="background: #e3f2fd; padding: 15px; border-left: 4px solid #0d6efd; margin-top: 20px;">
                <strong>Nota:</strong> Este es un correo automático, por favor no responder.
            </div>
        </div>
        <div class="footer">
            <p>Punina Care - Sistema Médico Electrónico &copy; {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>