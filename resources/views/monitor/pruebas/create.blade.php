@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Prueba</h1>
    <form action="{{ route('monitor.pruebas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_usuario">Usuario</label>
            <select name="id_usuario" class="form-control" required>
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id_usuario }}">{{ $usuario->nombre_usuario }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_tipo_prueba">Tipo de Prueba</label>
            <select name="id_tipo_prueba" class="form-control" required>
                @foreach($tiposPrueba as $tipo)
                <option value="{{ $tipo->id_tipo_prueba }}">{{ $tipo->nombre_tipo_prueba }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_hora_inicio">Fecha Inicio</label>
            <input type="datetime-local" name="fecha_hora_inicio" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_hora_fin">Fecha Fin</label>
            <input type="datetime-local" name="fecha_hora_fin" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection