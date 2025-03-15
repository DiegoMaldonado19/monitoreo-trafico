<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\CalleController;
use App\Http\Controllers\Admin\SemaforoController;
use App\Http\Controllers\Monitor\PruebaController;
use App\Http\Controllers\Monitor\FlujoVehicularController;
use App\Http\Controllers\Supervisor\ReporteController;
use App\Http\Controllers\Supervisor\PruebaEstadoController;

// Rutas para el rol de Administrador
Route::prefix('admin')->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('calles', CalleController::class);
    Route::resource('semaforos', SemaforoController::class);
});

// Rutas para el rol de Monitor
Route::prefix('monitor')->group(function () {
    Route::resource('pruebas', PruebaController::class);
    Route::resource('flujo-vehicular', FlujoVehicularController::class);
});

// Rutas para el rol de Supervisor
Route::prefix('supervisor')->group(function () {
    Route::resource('reportes', ReporteController::class);
    Route::resource('pruebas-estado', PruebaEstadoController::class);
});