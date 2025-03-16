<!-- resources/views/admin/semaforos/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Semáforo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $semaforo->calle->nombre_calle }}</h5>
            <p class="card-text"><strong>Tiempo Verde:</strong> {{ $semaforo->tiempo_verde }} segundos</p>
            <p class="card-text"><strong>Tiempo Amarillo:</strong> {{ $semaforo->tiempo_amarillo }} segundos</p>
            <p class="card-text"><strong>Tiempo Rojo:</strong> {{ $semaforo->tiempo_rojo }} segundos</p>
            <a href="{{ route('admin.semaforos.edit', $semaforo->id_semaforo) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('admin.semaforos.destroy', $semaforo->id_semaforo) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection