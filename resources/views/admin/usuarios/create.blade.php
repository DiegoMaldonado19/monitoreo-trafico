<!-- resources/views/admin/usuarios/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>
    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <div class="form-group">
            <label for="id_rol">Rol</label>
            <select class="form-control" id="id_rol" name="id_rol" required>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->id_rol }}">{{ $rol->nombre_rol }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection