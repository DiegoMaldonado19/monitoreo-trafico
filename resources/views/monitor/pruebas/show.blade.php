@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Prueba</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $prueba->id_prueba }}</h5>
            <p class="card-text">Usuario: {{ $prueba->usuario->nombre_usuario }}</p>
            <p class="card-text">Tipo de Prueba: {{ $prueba->tipoPrueba->nombre_tipo_prueba }}</p>
            <p class="card-text">Fecha Inicio: {{ $prueba->fecha_hora_inicio }}</p>
            <p class="card-text">Fecha Fin: {{ $prueba->fecha_hora_fin }}</p>
            <a href="{{ route('monitor.pruebas.edit', $prueba->id_prueba) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection