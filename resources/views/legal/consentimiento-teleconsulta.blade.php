@extends('layouts.app')
@section('title', 'Consentimiento para Teleconsulta')
@section('page-title', 'Consentimiento para Teleconsulta')
@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h1 class="mb-4 text-primary fw-bold">Consentimiento Informado para Teleconsulta</h1>
            <p class="text-muted">Documento para imprimir y firmar con el paciente antes de la videollamada.</p>
            <hr>

            <p>Yo, <strong>_________________________________________</strong>, con cédula de identidad <strong>___________________</strong>, en pleno uso de mis facultades, autorizo al <strong>Dr(a). _________________________________________</strong> a realizar una consulta médica a través de medios telemáticos (videollamada).</p>

            <h5 class="mt-4">Declaro haber sido informado sobre:</h5>
            <ul>
                <li><strong>Riesgos técnicos:</strong> La comunicación electrónica puede presentar fallas de conexión, retrasos o interrupciones. A pesar de los esfuerzos de seguridad, existe un riesgo mínimo de que la información sea interceptada.</li>
                <li><strong>Confidencialidad:</strong> La consulta se realizará a través de un servidor privado de la clínica (Jitsi Meet), no en plataformas públicas.</li>
                <li><strong>No grabación:</strong> Ni el médico ni el paciente grabarán la consulta.</li>
                <li><strong>Limitaciones:</strong> La teleconsulta no reemplaza una evaluación física presencial si el médico lo considera necesario.</li>
            </ul>

            <p class="mt-4">Entiendo que puedo retirar este consentimiento en cualquier momento y solicitar una consulta presencial.</p>

            <div class="row mt-5">
                <div class="col-md-6 text-center">
                    <div class="border-top border-dark w-75 mx-auto pt-2">Firma del Paciente</div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="border-top border-dark w-75 mx-auto pt-2">Firma del Médico</div>
                </div>
            </div>
            <div class="text-center mt-4 text-muted small">Fecha: ___________________</div>
            <div class="text-center mt-4">
                <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print me-1"></i> Imprimir Documento</button>
            </div>
        </div>
    </div>
</div>
@endsection
