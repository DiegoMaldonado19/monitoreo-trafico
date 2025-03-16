<!-- resources/views/admin/calles/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Calle</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $calle->nombre_calle }}</h5>
            <p class="card-text"><strong>Tipo de Calle:</strong> {{ $calle->tipoCalle->nombre_tipo_calle }}</p>
            <a href="{{ route('admin.calles.edit', $calle->id_calle) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('admin.calles.destroy', $calle->id_calle) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection