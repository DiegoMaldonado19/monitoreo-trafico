<!-- resources/views/admin/usuarios/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $usuario->nombre_usuario }}</h5>
            <p class="card-text"><strong>Rol:</strong> {{ $usuario->rol->nombre_rol }}</p>
            <a href="{{ route('admin.usuarios.edit', $usuario->id_usuario) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('admin.usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection