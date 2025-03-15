@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>
    <form action="{{ route('admin.usuarios.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_usuario">Nombre de Usuario</label>
            <input type="text" name="nombre_usuario" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_rol">Rol</label>
            <select name="id_rol" class="form-control" required>
                @foreach($roles as $rol)
                <option value="{{ $rol->id_rol }}">{{ $rol->nombre_rol }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection