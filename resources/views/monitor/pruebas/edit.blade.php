@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Prueba</h1>
    <form action="{{ route('monitor.pruebas.update', $prueba->id_prueba) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_usuario">Usuario</label>
            <select name="id_usuario" class="form-control" required>
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id_usuario }}" {{ $prueba->id_usuario == $usuario->id_usuario ? 'selected' : '' }}>{{ $usuario->nombre_usuario }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_tipo_prueba">Tipo de Prueba</label>
            <select name="id_tipo_prueba" class="form-control" required>
                @foreach($tiposPrueba as $tipo)
                <option value="{{ $tipo->id_tipo_prueba }}" {{ $prueba->id_tipo_prueba == $tipo->id_tipo_prueba ? 'selected' : '' }}>{{ $tipo->nombre_tipo_prueba }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_hora_inicio">Fecha Inicio</label>
            <input type="datetime-local" name="fecha_hora_inicio" class="form-control" value="{{ $prueba->fecha_hora_inicio }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_hora_fin">Fecha Fin</label>
            <input type="datetime-local" name="fecha_hora_fin" class="form-control" value="{{ $prueba->fecha_hora_fin }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection