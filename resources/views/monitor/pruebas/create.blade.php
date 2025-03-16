<!-- resources/views/monitor/pruebas/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Prueba</h1>
    <form method="POST" action="{{ route('monitor.pruebas.store') }}">
        @csrf
        <div class="form-group">
            <label for="id_tipo_prueba">Tipo de Prueba</label>
            <select class="form-control" id="id_tipo_prueba" name="id_tipo_prueba" required>
                @foreach ($tiposPrueba as $tipoPrueba)
                    <option value="{{ $tipoPrueba->id_tipo_prueba }}">{{ $tipoPrueba->nombre_tipo_prueba }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection