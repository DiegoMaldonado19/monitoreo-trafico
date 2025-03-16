<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Monitor\MonitorController;
use App\Http\Controllers\Supervisor\SupervisorController;
use App\Http\Controllers\Reporte\ReporteController;

// Ruta de inicio (redirige al login)
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas para el Administrador
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('usuarios', AdminController::class);
        Route::resource('calles', CalleController::class);
        Route::resource('semaforos', SemaforoController::class);
    });

    // Rutas para el Monitor
    Route::prefix('monitor')->name('monitor.')->group(function () {
        Route::resource('flujo-vehicular', FlujoVehicularController::class);
        Route::resource('pruebas', PruebaController::class);
    });

    // Rutas para el Supervisor
    Route::prefix('supervisor')->name('supervisor.')->group(function () {
        Route::resource('reportes', ReporteController::class);
        Route::get('reportes/generar', [ReporteController::class, 'generarReporte'])->name('reportes.generar');
    });
});
