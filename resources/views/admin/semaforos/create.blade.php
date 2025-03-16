<!-- resources/views/admin/semaforos/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Semáforo</h1>
    <form method="POST" action="{{ route('admin.semaforos.store') }}">
        @csrf
        <div class="form-group">
            <label for="id_calle">Calle</label>
            <select class="form-control" id="id_calle" name="id_calle" required>
                @foreach ($calles as $calle)
                    <option value="{{ $calle->id_calle }}">{{ $calle->nombre_calle }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="tiempo_verde">Tiempo Verde (segundos)</label>
            <input type="number" class="form-control" id="tiempo_verde" name="tiempo_verde" required>
        </div>
        <div class="form-group">
            <label for="tiempo_amarillo">Tiempo Amarillo (segundos)</label>
            <input type="number" class="form-control" id="tiempo_amarillo" name="tiempo_amarillo" required>
        </div>
        <div class="form-group">
            <label for="tiempo_rojo">Tiempo Rojo (segundos)</label>
            <input type="number" class="form-control" id="tiempo_rojo" name="tiempo_rojo" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection