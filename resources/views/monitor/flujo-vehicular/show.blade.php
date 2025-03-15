@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Flujo Vehicular</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $flujo->id_flujo }}</h5>
            <p class="card-text">Semáforo: {{ $flujo->semaforo->id_semaforo }}</p>
            <p class="card-text">Fecha y Hora: {{ $flujo->fecha_hora }}</p>
            <p class="card-text">Velocidad Promedio: {{ $flujo->velocidad_promedio }}</p>
            <a href="{{ route('monitor.flujo-vehicular.edit', $flujo->id_flujo) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection