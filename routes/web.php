<?php

use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\CalleController;
use App\Http\Controllers\Admin\SemaforoController;
use App\Http\Controllers\Monitor\PruebaController;
use App\Http\Controllers\Monitor\FlujoVehicularController;
use App\Http\Controllers\Supervisor\ReporteController;
use App\Http\Controllers\Supervisor\PruebaEstadoController;
use App\Http\Controllers\Simulaciones\SimulacionController;

// Rutas para el rol de Administrador
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('calles', CalleController::class);
    Route::resource('semaforos', SemaforoController::class);
});

// Rutas para el rol de Monitor
Route::prefix('monitor')->name('monitor.')->group(function () {
    Route::resource('pruebas', PruebaController::class);
    Route::resource('flujo-vehicular', FlujoVehicularController::class);
});

// Rutas para el rol de Supervisor
Route::prefix('supervisor')->name('supervisor.')->group(function () {
    Route::resource('reportes', ReporteController::class);
    Route::resource('pruebas-estado', PruebaEstadoController::class);
});

// Rutas para Simulaciones
Route::prefix('simulaciones')->name('simulaciones.')->group(function () {
    Route::get('/', [SimulacionController::class, 'index'])->name('index');
    Route::get('/cargar-json', [SimulacionController::class, 'cargarJson'])->name('cargarJson');
    Route::post('/guardar-json', [SimulacionController::class, 'guardarJson'])->name('guardarJson');
    Route::get('/tiempo-real', [SimulacionController::class, 'tiempoReal'])->name('tiempoReal');
});

// Ruta de inicio (página principal)
Route::get('/', function () {
    return view('welcome'); // Puedes cambiar esto por la vista que desees como página principal.
});