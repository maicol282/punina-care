<div class="col-md-4 mb-4">
    <!-- Tarjeta de Perfil del Paciente -->
    <div class="card">
        <div class="card-body text-center">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                 style="width: 100px; height: 100px; font-size: 40px;">
                {{ substr($paciente->nombre, 0, 1) }}{{ substr($paciente->apellido, 0, 1) }}
            </div>
            <h4>{{ $paciente->nombre_completo }}</h4>
            <p class="text-muted">
                <i class="fas fa-envelope me-1"></i> {{ $paciente->email }}<br>
                <i class="fas fa-phone me-1"></i> {{ $paciente->telefono }}
            </p>
            
            <div class="d-grid gap-2">
                @can('editar pacientes')
                <a href="{{ route('pacientes.edit', $paciente) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> Editar Perfil
                </a>
                @endcan
                
                @can('crear historiales')
                <a href="{{ route('historial.create', $paciente) }}" class="btn btn-success">
                    <i class="fas fa-plus-circle me-1"></i> Nuevo Historial
                </a>
                @endcan
                
                @if(auth()->user()->hasAnyRole(['Administrador', 'Médico']))
                <button type="button" class="btn btn-danger" 
                        onclick="confirmDelete(event, 'delete-paciente-form')">
                    <i class="fas fa-trash me-1"></i> Eliminar Paciente
                </button>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Información Adicional -->
    <div class="card mt-3">
        <div class="card-header">
            <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Información Adicional</h6>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-birthday-cake me-2 text-muted"></i>Edad:</span>
                    <span class="badge bg-info">{{ $paciente->edad }} años</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-venus-mars me-2 text-muted"></i>Género:</span>
                    <span>
                        @if($paciente->genero == 'M')
                            <i class="fas fa-mars text-primary"></i> Masculino
                        @elseif($paciente->genero == 'F')
                            <i class="fas fa-venus text-danger"></i> Femenino
                        @else
                            <i class="fas fa-genderless"></i> {{ $paciente->genero }}
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-id-card me-2 text-muted"></i>Cédula:</span>
                    <span class="badge bg-secondary">{{ $paciente->cedula ?? 'No registrada' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-briefcase me-2 text-muted"></i>Ocupación:</span>
                    <span class="badge bg-info">{{ $paciente->ocupacion ?? 'No registrada' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-map-marker-alt me-2 text-muted"></i>País:</span>
                    <span>{{ $paciente->pais ?? 'No especificado' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-map-marker-alt me-2 text-muted"></i>Provincia:</span>
                    <span>{{ $paciente->provincia ?? 'No especificado' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-map-marker-alt me-2 text-muted"></i>Ciudad:</span>
                    <span>{{ $paciente->ciudad ?? 'No especificado' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-home me-2 text-muted"></i>Dirección:</span>
                    <span>{{ $paciente->direccion ?? 'No especificada' }}</span>
                </li>
                @if($paciente->alergias)
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span><i class="fas fa-allergies me-2 text-danger"></i>Alergias:</span>
                    <span class="text-danger">{{ $paciente->alergias }}</span>
                </li>
                @endif
            </ul>
            
            @if($paciente->observaciones)
            <div class="mt-3 p-2 bg-info bg-opacity-10 rounded">
                <strong class="text-info"><i class="fas fa-comment me-1"></i>Observaciones:</strong>
                <p class="mb-0 mt-1">{{ $paciente->observaciones }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
