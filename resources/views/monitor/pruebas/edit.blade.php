<!-- resources/views/monitor/pruebas/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Prueba</h1>
    <form method="POST" action="{{ route('monitor.pruebas.update', $prueba->id_prueba) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_tipo_prueba">Tipo de Prueba</label>
            <select class="form-control" id="id_tipo_prueba" name="id_tipo_prueba" required>
                @foreach ($tiposPrueba as $tipoPrueba)
                    <option value="{{ $tipoPrueba->id_tipo_prueba }}" {{ $prueba->id_tipo_prueba == $tipoPrueba->id_tipo_prueba ? 'selected' : '' }}>{{ $tipoPrueba->nombre_tipo_prueba }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection