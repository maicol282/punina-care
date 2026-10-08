@extends('layouts.app')

@section('title', 'Mi Perfil')
@section('page-title', 'Editar Perfil')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-user me-2 text-primary"></i>Mi Perfil</h5>
    </div>
    <div class="card-body">
        
        <!-- ===== DATOS PERSONALES ===== -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ Auth::user()->cedula }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Especialidad</label>
                    <input type="text" name="especialidad" class="form-control" value="{{ Auth::user()->especialidad }}">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Guardar Cambios
            </button>
        </form>

        <hr>

        <!-- ===== FIRMA DIGITAL ===== -->
        <div class="card mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-signature me-2 text-primary"></i>Firma Digital</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        @if(Auth::user()->firma_path)
                            <div class="mb-3">
                                <label class="form-label">Firma actual</label>
                                <div>
                                    <img src="{{ asset('storage/' . Auth::user()->firma_path) }}" 
                                         alt="Firma" 
                                         style="max-height: 100px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                                </div>
                            </div>
                        @endif
                        
                        <form action="{{ route('profile.update.firma') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label class="form-label">Subir firma (PNG o JPG)</label>
                                <input type="file" name="firma" class="form-control" accept=".png,.jpg,.jpeg">
                                <small class="text-muted">La imagen debe ser transparente (fondo blanco). Tamaño recomendado: 300x100px.</small>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload me-1"></i> Guardar Firma
                            </button>
                            
                            @if(Auth::user()->firma_path)
                                <a href="{{ route('profile.delete.firma') }}" class="btn btn-danger" 
                                   onclick="return confirm('¿Eliminar firma?')">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </a>
                            @endif
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Recomendaciones:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Fondo blanco o transparente</li>
                                <li>Formato PNG (mejor calidad)</li>
                                <li>Tamaño máximo: 2MB</li>
                                <li>Dimensiones recomendadas: 300x100px</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
