@extends('layouts.app')
@section('title', 'Política de Privacidad')
@section('page-title', 'Política de Privacidad')
@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h1 class="mb-4 text-primary fw-bold">Política de Privacidad</h1>
            <p class="text-muted">Última actualización: {{ date('d/m/Y') }}</p>
            <hr>

            <div class="alert alert-warning border-0 shadow-sm mb-4">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Aviso de Transparencia:</strong> Este sistema está en fase de despliegue. Mientras no se instale el servidor propio de videollamadas, las teleconsultas se realizan a través de Jitsi Meet público, que no está diseñado para datos de salud sensibles.
            </div>

            <h4>1. Responsable del Tratamiento</h4>
            <p>El responsable del tratamiento de sus datos personales es el consultorio médico que utiliza este sistema. Para ejercer sus derechos (acceso, rectificación, eliminación), contacte directamente a su médico tratante.</p>

            <h4>2. Datos que Recopilamos</h4>
            <p>Recopilamos datos de identificación (nombres, apellidos, cédula, fecha de nacimiento), datos de contacto (teléfono, email, dirección) y datos de salud (historial clínico, diagnósticos, recetas, resultados de exámenes).</p>

            <h4>3. Finalidad del Tratamiento</h4>
            <p>Los datos son utilizados exclusivamente para la atención médica, elaboración de historiales clínicos, generación de recetas y certificados, y para la comunicación con el paciente.</p>

            <h4>4. Medidas de Seguridad</h4>
            <p>Implementamos medidas técnicas orientadas a la protección de datos: encriptación AES-256 para datos sensibles (cédula, email), contraseñas cifradas con bcrypt, acceso restringido mediante roles y permisos, y registro de auditoría (logs).</p>

            <h4>5. Transferencia a Terceros</h4>
            <p>Para el funcionamiento del sistema, compartimos datos estrictamente necesarios con:</p>
            <ul>
                <li><strong>Groq (IA):</strong> Recibe datos clínicos <strong>anonimizados</strong> (sin nombre ni cédula) para generar sugerencias médicas. No se envía información que identifique al paciente.</li>
                <li><strong>Jitsi Meet:</strong> Plataforma de videollamada para teleconsultas. <strong>Advertencia:</strong> Mientras se use el servidor público (<code>meet.jit.si</code>), la comunicación no está cifrada de extremo a extremo y cualquier persona con el enlace puede unirse. Una vez instalado el servidor propio, se garantizará la privacidad de la sala.</li>
                <li><strong>Gmail (Google):</strong> Servicio de correo para el envío de recetas y certificados. Los datos de salud se transmiten a través de servidores de Google (EE.UU.).</li>
            </ul>

            <h4>6. Derechos del Titular</h4>
            <p>Los pacientes tienen derecho a acceder, rectificar, eliminar y oponerse al tratamiento de sus datos. Para ejercer estos derechos, deben contactar al médico tratante o al correo electrónico habilitado por el consultorio.</p>

            <h4>7. Uso de Inteligencia Artificial</h4>
            <p>El sistema utiliza IA (Groq) como herramienta de apoyo. Las sugerencias generadas por la IA <strong>no reemplazan el juicio clínico del médico</strong>. El médico es el único responsable de las decisiones médicas tomadas.</p>
        </div>
    </div>
</div>
@endsection
