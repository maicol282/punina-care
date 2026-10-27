@extends('layouts.app')

@section('title', 'Pedidos de Exámenes')
@section('page-title', 'Pedidos de Exámenes')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-flask me-2 text-primary"></i>
            @if(isset($paciente))
                Pedidos de Exámenes - {{ $paciente->nombre_completo }}
            @else
                Todos los Pedidos de Exámenes
            @endif
        </h5>
        @if(isset($paciente))
        <a href="{{ route('pacientes.show', $paciente->id) }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Volver al Paciente
        </a>
        @endif
    </div>
    <div class="card-body">
        @if($pedidos->isEmpty())
            <div class="text-center py-4">
                <i class="fas fa-flask fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hay pedidos de exámenes registrados</h5>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            @if(!isset($paciente))
                                <th>Paciente</th>
                            @endif
                            <th>Fecha</th>
                            <th>Médico</th>
                            <th>Exámenes</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->id }}</td>
                            @if(!isset($paciente))
                                <td>{{ $pedido->paciente->nombre_completo }}</td>
                            @endif
                            <td>{{ $pedido->fecha_pedido->format('d/m/Y') }}</td>
                            <td>{{ $pedido->medico->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $pedido->detalles->count() }} exámenes</span>
                            </td>
                            <td>
                                @if($pedido->estado == 'pendiente')
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                @elseif($pedido->estado == 'completado')
                                    <span class="badge bg-success">Completado</span>
                                @else
                                    <span class="badge bg-danger">Cancelado</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pedidos-examenes.enviar', $pedido) }}" class="btn btn-sm btn-info text-white" title="Enviar por Correo" onclick="return confirm('¿Enviar pedido al paciente?')">
                                 <i class="fas fa-envelope"></i>
                                </a>
                                @if($pedido->enviado)
                                 <span class="badge bg-success">Enviado</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pedidos-examenes.pdf', $pedido) }}" class="btn btn-sm btn-danger" target="_blank" title="Ver PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if(!isset($paciente))
                <div class="mt-3">
                    {{ $pedidos->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
@endsection