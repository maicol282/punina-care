@if(isset($breadcrumbs))
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb bg-light p-3 rounded-3 shadow-sm mb-0">
        <li class="breadcrumb-item">
            @role('Administrador|Médico')
<a href="{{ route('dashboard') }}" class="...">
    <i class="fas fa-home me-1"></i> Inicio
</a>
@endrole
        </li>
        @foreach($breadcrumbs as $label => $url)
            @if($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $url }}" class="text-decoration-none">{{ $label }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
@endif
