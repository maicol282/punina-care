<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\HistorialClinicoController;
use App\Http\Controllers\HistorialesController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AdjuntoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\Cie10Controller;
use App\Http\Controllers\TextoPredictivoController;
use App\Http\Controllers\ExportacionController;
use App\Http\Controllers\BusquedaGlobalController;
use App\Http\Controllers\AutocompletadoController;
use App\Http\Controllers\SeguridadDashboardController;
use App\Http\Controllers\CertificadoMedicoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConsultaTelemedicinaController;
use App\Http\Controllers\ReposoController;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    
    // =====================================================
    // DASHBOARD - REDIRIGIR AL NUEVO DASHBOARD DE SEGURIDAD
    // =====================================================
    Route::get('/dashboard', function() {
        return redirect()->route('seguridad.dashboard');
    })->name('dashboard');
    
    // =====================================================
    // BÚSQUEDA Y EXPORTACIÓN
    // =====================================================
    Route::get('/pacientes/search', [PacienteController::class, 'search'])->name('pacientes.search');
    
    Route::prefix('exportar')->group(function () {
        Route::get('/pacientes', [ExportacionController::class, 'exportPacientes'])->name('exportar.pacientes');
        Route::get('/historiales', [ExportacionController::class, 'exportAllHistoriales'])->name('exportar.historiales');
        Route::get('/paciente/{paciente}/historial', [ExportacionController::class, 'exportHistorialPaciente'])->name('exportar.historial.paciente');
        Route::get('/recetas', [ExportacionController::class, 'exportAllRecetas'])->name('exportar.recetas');
        Route::get('/paciente/{paciente}/recetas', [ExportacionController::class, 'exportRecetasPaciente'])->name('exportar.recetas.paciente');
    });

    // =====================================================
    // PACIENTES
    // =====================================================
    Route::resource('pacientes', PacienteController::class);
    
    // =====================================================
    // HISTORIAL CLÍNICO
    // =====================================================
    Route::get('/historiales', [HistorialesController::class, 'index'])->name('historiales.index');
    
    Route::get('/pacientes/{paciente}/historial/create', [HistorialClinicoController::class, 'create'])->name('historial.create');
    Route::post('/pacientes/{paciente}/historial', [HistorialClinicoController::class, 'store'])->name('historial.store');
    Route::get('/historial/{historial}', [HistorialClinicoController::class, 'show'])->name('historial.show');
    Route::get('/historial/{historial}/edit', [HistorialClinicoController::class, 'edit'])->name('historial.edit');
    Route::put('/historial/{historial}', [HistorialClinicoController::class, 'update'])->name('historial.update');
    Route::delete('/historial/{historial}', [HistorialClinicoController::class, 'destroy'])->name('historial.destroy');
    
// =====================================================
// SEGUIMIENTOS
// =====================================================
Route::get('/historial/{historial}/seguimientos/create', [SeguimientoController::class, 'create'])->name('seguimientos.create');
Route::post('/historial/{historial}/seguimientos', [SeguimientoController::class, 'store'])->name('seguimientos.store');
Route::get('/seguimientos/{seguimiento}', [SeguimientoController::class, 'show'])->name('seguimientos.show'); // ← NUEVA
Route::get('/seguimientos/{seguimiento}/edit', [SeguimientoController::class, 'edit'])->name('seguimientos.edit');
Route::put('/seguimientos/{seguimiento}', [SeguimientoController::class, 'update'])->name('seguimientos.update');
Route::delete('/seguimientos/{seguimiento}', [SeguimientoController::class, 'destroy'])->name('seguimientos.destroy');
    
    // =====================================================
    // REPORTES PDF
    // =====================================================
    Route::prefix('reportes')->group(function () {
        Route::get('/paciente/{paciente}', [ReporteController::class, 'historialPaciente'])->name('reportes.paciente');
        Route::get('/historial/{historial}', [ReporteController::class, 'historialUnico'])->name('reportes.historial');
    });
    
    // =====================================================
    // CITAS
    // =====================================================
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/eventos', [CitaController::class, 'getEventos'])->name('citas.eventos');
    
    // =====================================================
    // ADJUNTOS
    // =====================================================
    Route::post('/adjuntos/historial/{historial}', [AdjuntoController::class, 'store'])->name('adjuntos.store');
    Route::delete('/adjuntos/{adjunto}', [AdjuntoController::class, 'destroy'])->name('adjuntos.destroy');
    Route::get('/adjuntos/{adjunto}/download', [AdjuntoController::class, 'download'])->name('adjuntos.download');
    
    // =====================================================
    // USUARIOS
    // =====================================================
    Route::resource('usuarios', UsuarioController::class);

    // =====================================================
    // CIE-10
    // =====================================================
    Route::prefix('cie10')->group(function () {
        Route::get('/search', [Cie10Controller::class, 'search'])->name('cie10.search');
        Route::get('/by-diagnostico', [Cie10Controller::class, 'getByDiagnostico'])->name('cie10.by-diagnostico');
        Route::get('/{codigo}', [Cie10Controller::class, 'getByCode'])->name('cie10.get');
    });

    // =====================================================
    // RECETAS MÉDICAS
    // =====================================================
    Route::prefix('recetas')->group(function () {
        Route::get('/historial/{historial}', [RecetaController::class, 'index'])->name('recetas.index');
        Route::get('/historial/{historial}/create', [RecetaController::class, 'create'])->name('recetas.create');
        Route::post('/historial/{historial}', [RecetaController::class, 'store'])->name('recetas.store');
        Route::get('/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
        Route::put('/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
        Route::delete('/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');
        Route::get('/{receta}/imprimir', [RecetaController::class, 'imprimir'])->name('recetas.imprimir');
        Route::get('/historial/{historial}/imprimir-todas', [RecetaController::class, 'imprimirTodas'])->name('recetas.imprimir.todas');
    });
    
    Route::get('/recetas', [RecetaController::class, 'todas'])->name('recetas.todas');

    // =====================================================
    // TEXTO PREDICTIVO
    // =====================================================
    Route::get('/predictivo/search', [TextoPredictivoController::class, 'search'])->name('predictivo.search');
    Route::post('/predictivo/save', [TextoPredictivoController::class, 'save'])->name('predictivo.save');
    Route::get('/predictivo/precargar', [TextoPredictivoController::class, 'precargar'])->name('predictivo.precargar');

    // =====================================================
    // BUSCADOR GLOBAL
    // =====================================================
    Route::get('/buscar', [BusquedaGlobalController::class, 'buscar'])->name('buscar.global');

    // =====================================================
    // SEGURIDAD - DASHBOARD MEJORADO
    // =====================================================
    Route::get('seguridad/dashboard', [SeguridadDashboardController::class, 'index'])
        ->name('seguridad.dashboard');

// =====================================================
// REPOSOS MÉDICOS
// =====================================================
Route::resource('reposos', App\Http\Controllers\ReposoController::class)->except(['create']);
Route::get('/reposos/historial/{historial}/create', [App\Http\Controllers\ReposoController::class, 'create'])->name('reposos.create');
Route::get('/reposos/{reposo}/imprimir', [App\Http\Controllers\ReposoController::class, 'imprimir'])->name('reposos.imprimir');
Route::patch('/reposos/{reposo}/estado', [App\Http\Controllers\ReposoController::class, 'cambiarEstado'])->name('reposos.cambiarEstado');

// =====================================================
// ARCHIVOS ADJUNTOS DE ESTUDIOS
// =====================================================
Route::delete('/estudios-adjuntos/{id}', [HistorialClinicoController::class, 'eliminarArchivo'])->name('estudios.eliminar');
Route::get('/estudios-adjuntos/{id}/descargar', [HistorialClinicoController::class, 'descargarArchivo'])->name('estudios.descargar');

// =====================================================
// OBTENER ÚLTIMO HISTORIAL DEL PACIENTE
// =====================================================
Route::get('/pacientes/{paciente}/ultimo-historial', [App\Http\Controllers\HistorialClinicoController::class, 'ultimoHistorial'])
    ->name('pacientes.ultimo-historial')
    ->middleware(['auth']);

    // =====================================================
// CERTIFICADOS MÉDICOS
// =====================================================
Route::prefix('certificados')->middleware(['auth'])->group(function () {
    Route::get('/', [CertificadoMedicoController::class, 'index'])->name('certificados.index');
    Route::get('/historial/{historial}/create', [CertificadoMedicoController::class, 'create'])->name('certificados.create');
    Route::post('/', [CertificadoMedicoController::class, 'store'])->name('certificados.store');
    Route::get('/{certificado}', [CertificadoMedicoController::class, 'show'])->name('certificados.show');
    Route::get('/{certificado}/edit', [CertificadoMedicoController::class, 'edit'])->name('certificados.edit');
    Route::put('/{certificado}', [CertificadoMedicoController::class, 'update'])->name('certificados.update');
    Route::delete('/{certificado}', [CertificadoMedicoController::class, 'destroy'])->name('certificados.destroy');
    Route::get('/{certificado}/imprimir', [CertificadoMedicoController::class, 'imprimir'])->name('certificados.imprimir');
    Route::patch('/{certificado}/estado', [CertificadoMedicoController::class, 'cambiarEstado'])->name('certificados.cambiarEstado');

});
// perfol firma
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/update-firma', [ProfileController::class, 'updateFirma'])->name('profile.update.firma');
Route::get('/profile/delete-firma', [ProfileController::class, 'deleteFirma'])->name('profile.delete.firma');

// =====================================================
// PUNINA CARE - TELEMEDICINA
// =====================================================
Route::prefix('telemedicina')->middleware(['auth'])->group(function () {
    Route::post('/cerrar-video', function() {
        session()->forget('consulta_activa_id');
        return response()->json(['success' => true]);
    })->name('telemedicina.cerrarVideo');
    Route::get('/', [ConsultaTelemedicinaController::class, 'index'])->name('telemedicina.index');
    Route::get('/create', [ConsultaTelemedicinaController::class, 'create'])->name('telemedicina.create');
    Route::post('/', [ConsultaTelemedicinaController::class, 'store'])->name('telemedicina.store');
    Route::get('/{consulta}/sala', [ConsultaTelemedicinaController::class, 'sala'])->name('telemedicina.sala');
    Route::get('/{consulta}/popup', [ConsultaTelemedicinaController::class, 'popup'])->name('telemedicina.popup');
    Route::get('/{consulta}', [ConsultaTelemedicinaController::class, 'show'])->name('telemedicina.show');
    Route::get('/{consulta}/edit', [ConsultaTelemedicinaController::class, 'edit'])->name('telemedicina.edit');
    Route::put('/{consulta}', [ConsultaTelemedicinaController::class, 'update'])->name('telemedicina.update');
    Route::delete('/{consulta}', [ConsultaTelemedicinaController::class, 'destroy'])->name('telemedicina.destroy');
    Route::post('/{consulta}/iniciar', [ConsultaTelemedicinaController::class, 'iniciar'])->name('telemedicina.iniciar');
    Route::post('/{consulta}/finalizar', [ConsultaTelemedicinaController::class, 'finalizar'])->name('telemedicina.finalizar');
    Route::post('/{consulta}/cancelar', [ConsultaTelemedicinaController::class, 'cancelar'])->name('telemedicina.cancelar');
});

// =====================================================
// ASISTENTE MÉDICO IA - PUNINA CARE
// =====================================================
Route::get('/asistente-ia', function () {
    return view('ia.index');
})->name('ia.index')->middleware(['auth']);

// =====================================================
// RECETAS MÉDICAS
// =====================================================
Route::prefix('recetas')->group(function () {
    // ... rutas existentes ...
    Route::get('/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
    Route::put('/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
    // ... resto de rutas ...
});

});

// =====================================================
// AUTOCOMPLETADO (FUERA DEL GRUPO AUTH POR SI ES PÚBLICO)
// =====================================================
Route::get('/autocompletado/search', [AutocompletadoController::class, 'search'])->name('autocompletado.search');
Route::post('/autocompletado/save', [AutocompletadoController::class, 'save'])->name('autocompletado.save');
Route::get('/autocompletado/precargar', [AutocompletadoController::class, 'precargar'])->name('autocompletado.precargar');
