@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Estado de Prueba</h1>
    <form action="{{ route('supervisor.pruebas-estado.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_prueba">Prueba</label>
            <select name="id_prueba" class="form-control" required>
                @foreach($pruebas as $prueba)
                <option value="{{ $prueba->id_prueba }}">{{ $prueba->id_prueba }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_tipo_estado">Estado</label>
            <select name="id_tipo_estado" class="form-control" required>
                @foreach($tiposEstado as $estado)
                <option value="{{ $estado->id_tipo_estado }}">{{ $estado->tipo_estado }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_tipo_vehiculo">Tipo de Vehículo</label>
            <select name="id_tipo_vehiculo" class="form-control" required>
                @foreach($tiposVehiculo as $vehiculo)
                <option value="{{ $vehiculo->id_tipo_vehiculo }}">{{ $vehiculo->nombre_tipo_vehiculo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cantidad_vehiculos">Cantidad de Vehículos</label>
            <input type="number" name="cantidad_vehiculos" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="velocidad_promedio">Velocidad Promedio</label>
            <input type="number" step="0.01" name="velocidad_promedio" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection