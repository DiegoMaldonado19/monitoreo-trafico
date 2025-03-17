<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Monitor\MonitorController;
use App\Http\Controllers\Monitor\SimulacionController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Reporte\ReporteController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->middleware('role:Administrador')->group(function () {
        Route::get('usuarios', [AdminController::class, 'indexUsuarios'])->name('usuarios.index');
        Route::get('usuarios/create', [AdminController::class, 'createUsuario'])->name('usuarios.create');
        Route::post('usuarios', [AdminController::class, 'storeUsuario'])->name('usuarios.store');
        Route::get('usuarios/{id}/edit', [AdminController::class, 'editUsuario'])->name('usuarios.edit');
        Route::put('usuarios/{id}', [AdminController::class, 'updateUsuario'])->name('usuarios.update');
        Route::delete('usuarios/{id}', [AdminController::class, 'destroyUsuario'])->name('usuarios.destroy');

        Route::get('calles', [AdminController::class, 'indexCalles'])->name('calles.index');
        Route::get('calles/create', [AdminController::class, 'createCalle'])->name('calles.create');
        Route::post('calles', [AdminController::class, 'storeCalle'])->name('calles.store');
        Route::get('calles/{id}/edit', [AdminController::class, 'editCalle'])->name('calles.edit');
        Route::put('calles/{id}', [AdminController::class, 'updateCalle'])->name('calles.update');
        Route::delete('calles/{id}', [AdminController::class, 'destroyCalle'])->name('calles.destroy');

        Route::get('semaforos', [AdminController::class, 'indexSemaforos'])->name('semaforos.index');
        Route::get('semaforos/create', [AdminController::class, 'createSemaforo'])->name('semaforos.create');
        Route::post('semaforos', [AdminController::class, 'storeSemaforo'])->name('semaforos.store');
        Route::get('semaforos/{id}/edit', [AdminController::class, 'editSemaforo'])->name('semaforos.edit');
        Route::put('semaforos/{id}', [AdminController::class, 'updateSemaforo'])->name('semaforos.update');
        Route::delete('semaforos/{id}', [AdminController::class, 'destroySemaforo'])->name('semaforos.destroy');
    });

    // Rutas para el Monitor
    Route::prefix('monitor')->name('monitor.')->middleware('role:Monitor')->group(function () {
        Route::get('flujo-vehicular', [MonitorController::class, 'indexFlujoVehicular'])->name('flujo-vehicular.index');
        Route::get('flujo-vehicular/create', [MonitorController::class, 'createFlujoVehicular'])->name('flujo-vehicular.create');
        Route::post('flujo-vehicular', [MonitorController::class, 'storeFlujoVehicular'])->name('flujo-vehicular.store');
        Route::get('flujo-vehicular/{id}/edit', [MonitorController::class, 'editFlujoVehicular'])->name('flujo-vehicular.edit');
        Route::put('flujo-vehicular/{id}', [MonitorController::class, 'updateFlujoVehicular'])->name('flujo-vehicular.update');
        Route::delete('flujo-vehicular/{id}', [MonitorController::class, 'destroyFlujoVehicular'])->name('flujo-vehicular.destroy');

        Route::get('pruebas', [MonitorController::class, 'indexPruebas'])->name('pruebas.index');
        Route::get('pruebas/create', [MonitorController::class, 'createPrueba'])->name('pruebas.create');
        Route::post('pruebas', [MonitorController::class, 'storePrueba'])->name('pruebas.store');
        Route::get('pruebas/{id}/edit', [MonitorController::class, 'editPrueba'])->name('pruebas.edit');
        Route::put('pruebas/{id}', [MonitorController::class, 'updatePrueba'])->name('pruebas.update');
        Route::delete('pruebas/{id}', [MonitorController::class, 'destroyPrueba'])->name('pruebas.destroy');

        Route::get('/monitor/pruebas/{id}', [MonitorController::class, 'show'])->name('pruebas.show');

        Route::get('pruebas/crear-json', [MonitorController::class, 'crearJson'])->name('pruebas.crear-json');
        Route::get('pruebas/crear-random', [MonitorController::class, 'crearRandom'])->name('pruebas.crear-random');
        Route::post('pruebas/cargar-json', [MonitorController::class, 'cargarJson'])->name('pruebas.cargar-json');
        Route::post('pruebas/cargar-random', [MonitorController::class, 'cargarRandom'])->name('pruebas.cargar-random');

        Route::get('simulacion/{id}', [SimulacionController::class, 'index'])->name('simulacion.index');
        Route::get('simulacion/data/{id}', [SimulacionController::class, 'getData'])->name('simulacion.data');
    });

    Route::prefix('supervisor')->name('supervisor.')->middleware('role:Supervisor')->group(function () {
        Route::get('reportes', [SupervisorController::class, 'indexReportes'])->name('reportes.index');
        Route::get('consultaResumenTrafico', [SupervisorController::class, 'consultaResumenTrafico'])->name('consultaResumenTrafico');
        Route::get('consultaIteracionesMonitor', [SupervisorController::class, 'consultaIteracionesMonitor'])->name('consultaIteracionesMonitor');
        Route::get('consultaFlujoSemaforo', [SupervisorController::class, 'consultaFlujoSemaforo'])->name('consultaFlujoSemaforo');
        Route::get('consultaCantidadPruebas', [SupervisorController::class, 'consultaCantidadPruebas'])->name('consultaCantidadPruebas');
        Route::get('consultaCantidadArchivos', [SupervisorController::class, 'consultaCantidadArchivos'])->name('consultaCantidadArchivos');
        Route::get('consultaTiempoPromedio', [SupervisorController::class, 'consultaTiempoPromedio'])->name('consultaTiempoPromedio');
        Route::get('consultaPruebasIntervalo', [SupervisorController::class, 'consultaPruebasIntervalo'])->name('consultaPruebasIntervalo');
    });
});