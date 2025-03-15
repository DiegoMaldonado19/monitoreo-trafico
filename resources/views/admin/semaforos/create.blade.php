@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Semáforo</h1>
    <form action="{{ route('admin.semaforos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_calle">Calle</label>
            <select name="id_calle" class="form-control" required>
                @foreach($calles as $calle)
                <option value="{{ $calle->id_calle }}">{{ $calle->nombre_calle }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tiempo_verde">Tiempo Verde (segundos)</label>
            <input type="number" name="tiempo_verde" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tiempo_amarillo">Tiempo Amarillo (segundos)</label>
            <input type="number" name="tiempo_amarillo" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tiempo_rojo">Tiempo Rojo (segundos)</label>
            <input type="number" name="tiempo_rojo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection