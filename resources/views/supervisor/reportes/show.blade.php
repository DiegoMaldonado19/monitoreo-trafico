<!-- resources/views/supervisor/reportes/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Reporte</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Reporte #{{ $reporte->id_reporte }}</h5>
            <p class="card-text"><strong>Fecha:</strong> {{ $reporte->fecha_hora }}</p>
            <p class="card-text"><strong>Prueba:</strong> {{ $reporte->prueba->id_prueba }}</p>
            <h6>Detalles del Flujo Vehicular:</h6>
            <ul>
                @foreach ($reporte->detalles as $detalle)
                    <li>{{ $detalle->tipoVehiculo->nombre_tipo_vehiculo }}: {{ $detalle->cantidad_vehiculos }} vehículos, Velocidad Promedio: {{ $detalle->velocidad_promedio }} km/h</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection