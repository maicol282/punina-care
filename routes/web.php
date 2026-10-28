<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    PacienteController,
    HistorialClinicoController,
    HistorialesController,
    SeguimientoController,
    ReporteController,
    CitaController,
    AdjuntoController,
    UsuarioController,
    RecetaController,
    Cie10Controller,
    TextoPredictivoController,
    ExportacionController,
    BusquedaGlobalController,
    AutocompletadoController,
    SeguridadDashboardController,
    CertificadoMedicoController,
    ProfileController,
    ConsultaTelemedicinaController,
    ReposoController
};

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Rutas Autenticadas
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // =====================================================================
    // 1. DASHBOARD
    // =====================================================================
    Route::get('/dashboard', fn() => redirect()->route('seguridad.dashboard'))
        ->name('dashboard');

    Route::get('/seguridad/dashboard', [SeguridadDashboardController::class, 'index'])
        ->name('seguridad.dashboard');

    Route::get('/seguridad/dashboard/exportar-excel', [SeguridadDashboardController::class, 'exportarExcel'])->name('seguridad.dashboard.exportar');

    // =====================================================================
    // 2. PACIENTES
    // =====================================================================
    Route::get('/pacientes/search', [PacienteController::class, 'search'])
        ->name('pacientes.search');

    Route::get('/pacientes/{paciente}/ultimo-historial', [HistorialClinicoController::class, 'ultimoHistorial'])
        ->name('pacientes.ultimo-historial');

    Route::resource('pacientes', PacienteController::class);

    // =====================================================================
    // 3. HISTORIALES (listado global)
    // =====================================================================
    Route::get('/historiales', [HistorialesController::class, 'index'])
        ->name('historiales.index');

    // =====================================================================
    // 4. HISTORIAL CLÍNICO (CRUD por paciente)
    // =====================================================================
    Route::get('/pacientes/{paciente}/historial/create', [HistorialClinicoController::class, 'create'])
        ->name('historial.create');

    Route::post('/pacientes/{paciente}/historial', [HistorialClinicoController::class, 'store'])
        ->name('historial.store');

    Route::get('/historial/{historial}', [HistorialClinicoController::class, 'show'])
        ->name('historial.show');

    Route::get('/historial/{historial}/edit', [HistorialClinicoController::class, 'edit'])
        ->name('historial.edit');

    Route::put('/historial/{historial}', [HistorialClinicoController::class, 'update'])
        ->name('historial.update');

    Route::delete('/historial/{historial}', [HistorialClinicoController::class, 'destroy'])
        ->name('historial.destroy');

        // ===== RUTAS DE PEDIDOS DE EXÁMENES =====
    Route::get('/pedidos-examenes/crear', [App\Http\Controllers\PedidoExamenController::class, 'create'])->name('pedidos-examenes.create');
    Route::post('/pedidos-examenes', [App\Http\Controllers\PedidoExamenController::class, 'store'])->name('pedidos-examenes.store');
    Route::get('/pedidos-examenes', [App\Http\Controllers\PedidoExamenController::class, 'index'])->name('pedidos-examenes.index');
    Route::get('/pedidos-examenes/{pedido}/pdf', [App\Http\Controllers\PedidoExamenController::class, 'pdf'])->name('pedidos-examenes.pdf');
    

    // =====================================================================
    // 5. SEGUIMIENTOS
    // =====================================================================
    Route::get('/historial/{historial}/seguimientos/create', [SeguimientoController::class, 'create'])
        ->name('seguimientos.create');

    Route::post('/historial/{historial}/seguimientos', [SeguimientoController::class, 'store'])
        ->name('seguimientos.store');

    Route::get('/seguimientos/{seguimiento}', [SeguimientoController::class, 'show'])
        ->name('seguimientos.show');

    Route::get('/seguimientos/{seguimiento}/edit', [SeguimientoController::class, 'edit'])
        ->name('seguimientos.edit');

    Route::put('/seguimientos/{seguimiento}', [SeguimientoController::class, 'update'])
        ->name('seguimientos.update');

    Route::delete('/seguimientos/{seguimiento}', [SeguimientoController::class, 'destroy'])
        ->name('seguimientos.destroy');

    // =====================================================================
    // 6. RECETAS MÉDICAS
    // =====================================================================
    Route::prefix('recetas')->name('recetas.')->group(function () {
        Route::get('/', [RecetaController::class, 'todas'])->name('todas');

        Route::get('/historial/{historial}', [RecetaController::class, 'index'])->name('index');
        Route::get('/historial/{historial}/create', [RecetaController::class, 'create'])->name('create');
        Route::post('/historial/{historial}', [RecetaController::class, 'store'])->name('store');
        Route::get('/historial/{historial}/imprimir-todas', [RecetaController::class, 'imprimirTodas'])->name('imprimir.todas');

        Route::get('/{receta}/edit', [RecetaController::class, 'edit'])->name('edit');
        Route::put('/{receta}', [RecetaController::class, 'update'])->name('update');
        Route::delete('/{receta}', [RecetaController::class, 'destroy'])->name('destroy');
        Route::get('/{receta}/imprimir', [RecetaController::class, 'imprimir'])->name('imprimir');
    });

    // =====================================================================
    // 7. CERTIFICADOS MÉDICOS
    // =====================================================================
    Route::prefix('certificados')->name('certificados.')->group(function () {
        Route::get('/', [CertificadoMedicoController::class, 'index'])->name('index');
        Route::get('/historial/{historial}/create', [CertificadoMedicoController::class, 'create'])->name('create');
        Route::post('/', [CertificadoMedicoController::class, 'store'])->name('store');
        Route::get('/{certificado}', [CertificadoMedicoController::class, 'show'])->name('show');
        Route::get('/{certificado}/edit', [CertificadoMedicoController::class, 'edit'])->name('edit');
        Route::put('/{certificado}', [CertificadoMedicoController::class, 'update'])->name('update');
        Route::delete('/{certificado}', [CertificadoMedicoController::class, 'destroy'])->name('destroy');
        Route::get('/{certificado}/imprimir', [CertificadoMedicoController::class, 'imprimir'])->name('imprimir');
        Route::patch('/{certificado}/estado', [CertificadoMedicoController::class, 'cambiarEstado'])->name('cambiarEstado');
    });

    // =====================================================================
    // 8. REPOSOS MÉDICOS
    // =====================================================================
    Route::resource('reposos', ReposoController::class)->except(['create']);
    Route::get('/reposos/historial/{historial}/create', [ReposoController::class, 'create'])->name('reposos.create');
    Route::get('/reposos/{reposo}/imprimir', [ReposoController::class, 'imprimir'])->name('reposos.imprimir');
    Route::patch('/reposos/{reposo}/estado', [ReposoController::class, 'cambiarEstado'])->name('reposos.cambiarEstado');

    // =====================================================================
    // 9. TELEMEDICINA
    // =====================================================================
    Route::prefix('telemedicina')->name('telemedicina.')->group(function () {
        Route::post('/cerrar-video', function () {
            session()->forget('consulta_activa_id');
            return response()->json(['success' => true]);
        })->name('cerrarVideo');

        Route::get('/', [ConsultaTelemedicinaController::class, 'index'])->name('index');
        Route::get('/create', [ConsultaTelemedicinaController::class, 'create'])->name('create');
        Route::post('/', [ConsultaTelemedicinaController::class, 'store'])->name('store');
        Route::get('/{consulta}/sala', [ConsultaTelemedicinaController::class, 'sala'])->name('sala');
        Route::get('/{consulta}/popup', [ConsultaTelemedicinaController::class, 'popup'])->name('popup');
        Route::get('/{consulta}', [ConsultaTelemedicinaController::class, 'show'])->name('show');
        Route::get('/{consulta}/edit', [ConsultaTelemedicinaController::class, 'edit'])->name('edit');
        Route::put('/{consulta}', [ConsultaTelemedicinaController::class, 'update'])->name('update');
        Route::delete('/{consulta}', [ConsultaTelemedicinaController::class, 'destroy'])->name('destroy');
        Route::post('/{consulta}/iniciar', [ConsultaTelemedicinaController::class, 'iniciar'])->name('iniciar');
        Route::post('/{consulta}/finalizar', [ConsultaTelemedicinaController::class, 'finalizar'])->name('finalizar');
        Route::post('/{consulta}/cancelar', [ConsultaTelemedicinaController::class, 'cancelar'])->name('cancelar');
    });

    // =====================================================================
    // 10. CITAS
    // =====================================================================
    Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');
    Route::get('/citas/eventos', [CitaController::class, 'getEventos'])->name('citas.eventos');

    // =====================================================================
    // 11. CIE-10
    // =====================================================================
    Route::prefix('cie10')->name('cie10.')->group(function () {
        Route::get('/search', [Cie10Controller::class, 'search'])->name('search');
        Route::get('/by-diagnostico', [Cie10Controller::class, 'getByDiagnostico'])->name('by-diagnostico');
        Route::get('/{codigo}', [Cie10Controller::class, 'getByCode'])->name('get');
    });

    // =====================================================================
    // 12. TEXTO PREDICTIVO Y AUTOCOMPLETADO
    // =====================================================================
    Route::prefix('predictivo')->name('predictivo.')->group(function () {
        Route::get('/search', [TextoPredictivoController::class, 'search'])->name('search');
        Route::post('/save', [TextoPredictivoController::class, 'save'])->name('save');
        Route::get('/precargar', [TextoPredictivoController::class, 'precargar'])->name('precargar');
    });

    Route::prefix('autocompletado')->name('autocompletado.')->group(function () {
        Route::get('/search', [AutocompletadoController::class, 'search'])->name('search');
        Route::post('/save', [AutocompletadoController::class, 'save'])->name('save');
        Route::get('/precargar', [AutocompletadoController::class, 'precargar'])->name('precargar');
    });

    // =====================================================================
    // 13. ADJUNTOS Y ESTUDIOS
    // =====================================================================
    Route::post('/adjuntos/historial/{historial}', [AdjuntoController::class, 'store'])->name('adjuntos.store');
    Route::delete('/adjuntos/{adjunto}', [AdjuntoController::class, 'destroy'])->name('adjuntos.destroy');
    Route::get('/adjuntos/{adjunto}/download', [AdjuntoController::class, 'download'])->name('adjuntos.download');

    Route::delete('/estudios-adjuntos/{id}', [HistorialClinicoController::class, 'eliminarArchivo'])->name('estudios.eliminar');
    Route::get('/estudios-adjuntos/{id}/descargar', [HistorialClinicoController::class, 'descargarArchivo'])->name('estudios.descargar');

    // =====================================================================
    // 14. REPORTES PDF
    // =====================================================================
    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/paciente/{paciente}', [ReporteController::class, 'historialPaciente'])->name('paciente');
        Route::get('/historial/{historial}', [ReporteController::class, 'historialUnico'])->name('historial');
    });

    // =====================================================================
    // 15. EXPORTACIONES (Excel/CSV)
    // =====================================================================
    Route::prefix('exportar')->name('exportar.')->group(function () {
        Route::get('/pacientes', [ExportacionController::class, 'exportPacientes'])->name('pacientes');
        Route::get('/historiales', [ExportacionController::class, 'exportAllHistoriales'])->name('historiales');
        Route::get('/paciente/{paciente}/historial', [ExportacionController::class, 'exportHistorialPaciente'])->name('historial.paciente');
        Route::get('/recetas', [ExportacionController::class, 'exportAllRecetas'])->name('recetas');
        Route::get('/paciente/{paciente}/recetas', [ExportacionController::class, 'exportRecetasPaciente'])->name('recetas.paciente');
    });

    // =====================================================================
    // 16. BÚSQUEDA GLOBAL
    // =====================================================================
    Route::get('/buscar', [BusquedaGlobalController::class, 'buscar'])->name('buscar.global');

    // =====================================================================
    // 17. ASISTENTE MÉDICO IA
    // =====================================================================
    // Ruta para mostrar la vista de IA
    Route::get('/asistente-ia', [App\Http\Controllers\IaController::class, 'index'])->name('ia.index');
    Route::post('/asistente-ia/chat', [App\Http\Controllers\IaController::class, 'chat'])->name('ia.chat');

    // =====================================================================
    // 18. USUARIOS
    // =====================================================================
    Route::resource('usuarios', UsuarioController::class);
    Route::post('/usuarios/{usuario}/reset-password', [App\Http\Controllers\UsuarioController::class, 'resetPassword'])->name('usuarios.reset-password');

    // =====================================================================
    // 19. PERFIL Y FIRMA
    // =====================================================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-firma', [ProfileController::class, 'updateFirma'])->name('profile.update.firma');
    Route::get('/profile/delete-firma', [ProfileController::class, 'deleteFirma'])->name('profile.delete.firma');
    Route::put('/profile/certificado', [ProfileController::class, 'updateCertificado'])->name('profile.update.certificado');
    Route::delete('/profile/certificado', [ProfileController::class, 'deleteCertificado'])->name('profile.delete.certificado');


    Route::get('/recetas/{receta}/enviar-correo', [App\Http\Controllers\RecetaController::class, 'enviarPorCorreo'])->name('recetas.enviar');
    Route::get('/pedidos-examenes/{pedido}/enviar-correo', [App\Http\Controllers\PedidoExamenController::class, 'enviarPorCorreo'])->name('pedidos-examenes.enviar');
    Route::get('/certificados/{certificado}/enviar-correo', [CertificadoMedicoController::class, 'enviarPorCorreo'])->name('certificados.enviar');
});