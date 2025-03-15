@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Pruebas</h1>
    <a href="{{ route('monitor.pruebas.create') }}" class="btn btn-primary">Crear Prueba</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Tipo de Prueba</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pruebas as $prueba)
            <tr>
                <td>{{ $prueba->id_prueba }}</td>
                <td>{{ $prueba->usuario->nombre_usuario }}</td>
                <td>{{ $prueba->tipoPrueba->nombre_tipo_prueba }}</td>
                <td>{{ $prueba->fecha_hora_inicio }}</td>
                <td>{{ $prueba->fecha_hora_fin }}</td>
                <td>
                    <a href="{{ route('monitor.pruebas.show', $prueba->id_prueba) }}" class="btn btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection