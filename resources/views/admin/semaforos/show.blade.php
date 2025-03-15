@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Semáforo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $semaforo->id_semaforo }}</h5>
            <p class="card-text">Calle: {{ $semaforo->calle->nombre_calle }}</p>
            <p class="card-text">Tiempo Verde: {{ $semaforo->tiempo_verde }} segundos</p>
            <p class="card-text">Tiempo Amarillo: {{ $semaforo->tiempo_amarillo }} segundos</p>
            <p class="card-text">Tiempo Rojo: {{ $semaforo->tiempo_rojo }} segundos</p>
            <a href="{{ route('admin.semaforos.edit', $semaforo->id_semaforo) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection