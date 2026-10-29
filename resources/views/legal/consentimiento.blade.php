@extends('layouts.app')
@section('title', 'Consentimiento Informado')
@section('page-title', 'Consentimiento Informado')
@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h1 class="mb-4 text-primary fw-bold">Consentimiento Informado</h1>
            <p class="text-muted">Documento para imprimir y firmar con el paciente.</p>
            <hr>

            <p>Yo, <strong>_________________________________________</strong>, con cédula de identidad <strong>___________________</strong>, en pleno uso de mis facultades mentales, autorizo al <strong>Dr(a). _________________________________________</strong> a:</p>

            <ol>
                <li>Realizar la atención médica correspondiente y registrar mi información clínica en el sistema <strong>Punina Care</strong>.</li>
                <li>Almacenar mis datos personales y de salud en dicho sistema, con las medidas de seguridad implementadas (encriptación de datos sensibles y acceso restringido).</li>
                <li>Utilizar mis datos clínicos de forma <strong>anonimizada</strong> para herramientas de apoyo con Inteligencia Artificial (Groq), sin que mi identidad sea revelada.</li>
                <li>Realizar teleconsultas a través de plataformas de videollamada (Jitsi Meet).</li>
            </ol>

            <p>Declaro haber sido informado sobre:</p>
            <ul>
                <li>La finalidad del tratamiento de mis datos (atención médica e historial clínico).</li>
                <li>Mi derecho a acceder, rectificar o eliminar mis datos en cualquier momento.</li>
                <li>Que puedo revocar este consentimiento contactando a mi médico tratante.</li>
            </ul>

            <div class="row mt-5">
                <div class="col-md-6 text-center">
                    <div class="border-top border-dark w-75 mx-auto pt-2">
                        Firma del Paciente
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="border-top border-dark w-75 mx-auto pt-2">
                        Firma del Médico
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 text-muted small">
                Fecha: ___________________
            </div>

            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print me-1"></i> Imprimir Documento
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
