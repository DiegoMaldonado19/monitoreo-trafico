@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Semáforos</h1>
    <a href="{{ route('admin.semaforos.create') }}" class="btn btn-primary">Crear Semáforo</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Calle</th>
                <th>Tiempo Verde</th>
                <th>Tiempo Amarillo</th>
                <th>Tiempo Rojo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semaforos as $semaforo)
            <tr>
                <td>{{ $semaforo->id_semaforo }}</td>
                <td>{{ $semaforo->calle->nombre_calle }}</td>
                <td>{{ $semaforo->tiempo_verde }}</td>
                <td>{{ $semaforo->tiempo_amarillo }}</td>
                <td>{{ $semaforo->tiempo_rojo }}</td>
                <td>
                    <a href="{{ route('admin.semaforos.edit', $semaforo->id_semaforo) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.semaforos.destroy', $semaforo->id_semaforo) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection