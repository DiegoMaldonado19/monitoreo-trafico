<!-- resources/views/admin/calles/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Calle</h1>
    <form method="POST" action="{{ route('admin.calles.update', $calle->id_calle) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_calle">Nombre de la Calle</label>
            <input type="text" class="form-control" id="nombre_calle" name="nombre_calle" value="{{ $calle->nombre_calle }}" required>
        </div>
        <div class="form-group">
            <label for="id_tipo_calle">Tipo de Calle</label>
            <select class="form-control" id="id_tipo_calle" name="id_tipo_calle" required>
                @foreach ($tiposCalle as $tipoCalle)
                    <option value="{{ $tipoCalle->id_tipo_calle }}" {{ $calle->id_tipo_calle == $tipoCalle->id_tipo_calle ? 'selected' : '' }}>{{ $tipoCalle->nombre_tipo_calle }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection