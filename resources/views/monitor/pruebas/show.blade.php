<!-- resources/views/monitor/pruebas/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Prueba</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Prueba #{{ $prueba->id_prueba }}</h5>
            <p class="card-text"><strong>Tipo de Prueba:</strong> {{ $prueba->tipoPrueba->nombre_tipo_prueba }}</p>
            <p class="card-text"><strong>Fecha Inicio:</strong> {{ $prueba->fecha_hora_inicio }}</p>
            <p class="card-text"><strong>Fecha Fin:</strong> {{ $prueba->fecha_hora_fin }}</p>
        </div>
    </div>
</div>
@endsection