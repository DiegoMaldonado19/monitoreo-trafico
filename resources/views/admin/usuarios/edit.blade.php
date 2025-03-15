@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>
    <form action="{{ route('admin.usuarios.update', $usuario->id_usuario) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" name="nombre_usuario" class="form-control" value="{{ $usuario->nombre_usuario }}" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_rol">Rol</label>
            <select name="id_rol" class="form-control" required>
                @foreach($roles as $rol)
                <option value="{{ $rol->id_rol }}" {{ $usuario->id_rol == $rol->id_rol ? 'selected' : '' }}>{{ $rol->nombre_rol }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection