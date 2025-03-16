<!-- resources/views/monitor/pruebas/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pruebas Realizadas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Tipo de Prueba</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pruebas as $prueba)
                <tr>
                    <td>{{ $prueba->fecha_hora_inicio }}</td>
                    <td>{{ $prueba->fecha_hora_fin }}</td>
                    <td>{{ $prueba->tipoPrueba->nombre_tipo_prueba }}</td>
                    <td>
                        <a href="{{ route('monitor.pruebas.show', $prueba->id_prueba) }}" class="btn btn-info">Ver Detalles</a>
                        <a href="{{ route('monitor.pruebas.edit', $prueba->id_prueba) }}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection