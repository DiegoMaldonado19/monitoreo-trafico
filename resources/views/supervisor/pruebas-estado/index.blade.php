@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Estados de Pruebas</h1>
    <a href="{{ route('supervisor.pruebas-estado.create') }}" class="btn btn-primary">Crear Estado de Prueba</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prueba</th>
                <th>Estado</th>
                <th>Tipo de Vehículo</th>
                <th>Cantidad de Vehículos</th>
                <th>Velocidad Promedio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pruebasEstado as $estado)
            <tr>
                <td>{{ $estado->id_prueba_estado }}</td>
                <td>{{ $estado->prueba->id_prueba }}</td>
                <td>{{ $estado->tipoEstado->tipo_estado }}</td>
                <td>{{ $estado->tipoVehiculo->nombre_tipo_vehiculo }}</td>
                <td>{{ $estado->cantidad_vehiculos }}</td>
                <td>{{ $estado->velocidad_promedio }}</td>
                <td>
                    <a href="{{ route('supervisor.pruebas-estado.show', $estado->id_prueba_estado) }}" class="btn btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection