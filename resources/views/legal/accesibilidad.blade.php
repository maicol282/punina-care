@extends('layouts.app')
@section('title', 'Declaración de Accesibilidad')
@section('page-title', 'Declaración de Accesibilidad')
@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-5">
            <h1 class="mb-4 text-primary fw-bold">Declaración de Accesibilidad</h1>
            <p class="text-muted">Última actualización: {{ date('d/m/Y') }}</p>
            <hr>
            <p>En cumplimiento de la normativa ecuatoriana (NTE INEN-ISO/IEC 40500), Punina Care se compromete a garantizar la accesibilidad de su plataforma para personas con discapacidad.</p>
            <h4>Medidas adoptadas</h4>
            <ul>
                <li>Textos alternativos en imágenes y botones.</li>
                <li>Contraste de colores adecuado para facilitar la lectura.</li>
                <li>Navegación mediante teclado en los formularios principales.</li>
                <li>Diseño adaptable a diferentes tamaños de pantalla.</li>
            </ul>
            <h4>Contacto</h4>
            <p>Si encuentra alguna barrera de accesibilidad, por favor contacte al administrador del sistema para que podamos corregirla.</p>
        </div>
    </div>
</div>
@endsection
