@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Semáforo</h1>
    <form action="{{ route('admin.semaforos.update', $semaforo->id_semaforo) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_calle">Calle</label>
            <select name="id_calle" class="form-control" required>
                @foreach($calles as $calle)
                <option value="{{ $calle->id_calle }}" {{ $semaforo->id_calle == $calle->id_calle ? 'selected' : '' }}>{{ $calle->nombre_calle }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tiempo_verde">Tiempo Verde (segundos)</label>
            <input type="number" name="tiempo_verde" class="form-control" value="{{ $semaforo->tiempo_verde }}" required>
        </div>
        <div class="form-group">
            <label for="tiempo_amarillo">Tiempo Amarillo (segundos)</label>
            <input type="number" name="tiempo_amarillo" class="form-control" value="{{ $semaforo->tiempo_amarillo }}" required>
        </div>
        <div class="form-group">
            <label for="tiempo_rojo">Tiempo Rojo (segundos)</label>
            <input type="number" name="tiempo_rojo" class="form-control" value="{{ $semaforo->tiempo_rojo }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection