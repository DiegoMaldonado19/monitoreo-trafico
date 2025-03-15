@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Estado de Prueba</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $estado->id_prueba_estado }}</h5>
            <p class="card-text">Prueba: {{ $estado->prueba->id_prueba }}</p>
            <p class="card-text">Estado: {{ $estado->tipoEstado->tipo_estado }}</p>
            <p class="card-text">Tipo de Vehículo: {{ $estado->tipoVehiculo->nombre_tipo_vehiculo }}</p>
            <p class="card-text">Cantidad de Vehículos: {{ $estado->cantidad_vehiculos }}</p>
            <p class="card-text">Velocidad Promedio: {{ $estado->velocidad_promedio }}</p>
            <a href="{{ route('supervisor.pruebas-estado.edit', $estado->id_prueba_estado) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection