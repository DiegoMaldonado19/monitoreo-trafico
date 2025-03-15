@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Flujo Vehicular</h1>
    <form action="{{ route('monitor.flujo-vehicular.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_semaforo">Semáforo</label>
            <select name="id_semaforo" class="form-control" required>
                @foreach($semaforos as $semaforo)
                <option value="{{ $semaforo->id_semaforo }}">{{ $semaforo->id_semaforo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_hora">Fecha y Hora</label>
            <input type="datetime-local" name="fecha_hora" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="velocidad_promedio">Velocidad Promedio</label>
            <input type="number" step="0.01" name="velocidad_promedio" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection