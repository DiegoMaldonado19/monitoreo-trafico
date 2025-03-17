<!-- resources/views/monitor/pruebas/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Prueba</h1>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Prueba #{{ $prueba->id_prueba }}</h5>
            <p class="card-text"><strong>Tipo de Prueba:</strong> {{ $prueba->tipoPrueba->nombre_tipo_prueba }}</p>
            <p class="card-text"><strong>Fecha Inicio:</strong> {{ $prueba->fecha_hora_inicio }}</p>
            <p class="card-text"><strong>Fecha Fin:</strong> {{ $prueba->fecha_hora_fin }}</p>
            <a href="{{ route('monitor.pruebas.edit', $prueba->id_prueba) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>

    <!-- Mostrar flujos vehiculares -->
    <h2>Flujos Vehiculares</h2>
    @foreach ($prueba->flujosVehicularesPrueba as $flujo)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Flujo Vehicular #{{ $flujo->id_flujo_prueba }}</h5>
                <p class="card-text"><strong>Semáforo:</strong> {{ $flujo->id_semaforo }}</p>
                <p class="card-text"><strong>Fecha y Hora:</strong> {{ $flujo->fecha_hora }}</p>
                <p class="card-text"><strong>Velocidad Promedio:</strong> {{ $flujo->velocidad_promedio }} km/h</p>

                <!-- Mostrar detalles del flujo vehicular -->
                <h6>Detalles del Flujo Vehicular</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tipo de Vehículo</th>
                            <th>Cantidad de Vehículos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flujo->detallesFlujoVehicularPrueba as $detalle)
                            <tr>
                                <td>{{ $detalle->tipoVehiculo->nombre_tipo_vehiculo }}</td>
                                <td>{{ $detalle->cantidad_vehiculos }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection