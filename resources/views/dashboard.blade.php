<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenido, {{ auth()->user()->nombre_usuario }}</h1>
    <p>Rol: {{ auth()->user()->rol->nombre_rol }}</p>

    <div class="dashboard-links">
        @if (auth()->user()->rol->nombre_rol === 'Administrador')
            <h2>Funcionalidades de Administrador</h2>
            <ul>
                <li><a href="{{ route('admin.usuarios.index') }}">Gestionar Usuarios</a></li>
                <li><a href="{{ route('admin.calles.index') }}">Gestionar Calles</a></li>
                <li><a href="{{ route('admin.semaforos.index') }}">Gestionar Semáforos</a></li>
            </ul>
        @elseif (auth()->user()->rol->nombre_rol === 'Monitor')
            <h2>Funcionalidades de Monitor</h2>
            <ul>
                <li><a href="{{ route('monitor.pruebas.index') }}">Gestionar Pruebas</a></li>
            </ul>
        @elseif (auth()->user()->rol->nombre_rol === 'Supervisor')
            <h2>Funcionalidades de Supervisor</h2>
            <ul>
                <li><a href="{{ route('supervisor.reportes.index') }}">Ver Reportes</a></li>
                <li><a href="{{ route('supervisor.reportes.generar') }}">Generar Reporte</a></li>
            </ul>
        @endif
    </div>
</div>
@endsection