@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Usuarios</h1>
    <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary">Crear Usuario</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id_usuario }}</td>
                <td>{{ $usuario->nombre_usuario }}</td>
                <td>{{ $usuario->rol->nombre_rol }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $usuario->id_usuario) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection