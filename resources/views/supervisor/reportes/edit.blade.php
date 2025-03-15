@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Reporte</h1>
    <form action="{{ route('supervisor.reportes.update', $reporte->id_reporte) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_prueba">Prueba</label>
            <select name="id_prueba" class="form-control" required>
                @foreach($pruebas as $prueba)
                <option value="{{ $prueba->id_prueba }}" {{ $reporte->id_prueba == $prueba->id_prueba ? 'selected' : '' }}>{{ $prueba->id_prueba }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_hora">Fecha</label>
            <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ $reporte->fecha_hora }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection