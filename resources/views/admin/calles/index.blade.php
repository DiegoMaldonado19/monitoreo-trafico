@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Calles</h1>
    <a href="{{ route('admin.calles.create') }}" class="btn btn-primary">Crear Calle</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo de Calle</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($calles as $calle)
            <tr>
                <td>{{ $calle->id_calle }}</td>
                <td>{{ $calle->nombre_calle }}</td>
                <td>{{ $calle->tipoCalle->nombre_tipo_calle }}</td>
                <td>
                    <a href="{{ route('admin.calles.edit', $calle->id_calle) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.calles.destroy', $calle->id_calle) }}" method="POST" style="display:inline;">
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