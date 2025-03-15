@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Calle</h1>
    <form action="{{ route('admin.calles.update', $calle->id_calle) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_calle">Nombre de la Calle</label>
            <input type="text" name="nombre_calle" class="form-control" value="{{ $calle->nombre_calle }}" required>
        </div>
        <div class="form-group">
            <label for="id_tipo_calle">Tipo de Calle</label>
            <select name="id_tipo_calle" class="form-control" required>
                @foreach($tiposCalle as $tipo)
                <option value="{{ $tipo->id_tipo_calle }}" {{ $calle->id_tipo_calle == $tipo->id_tipo_calle ? 'selected' : '' }}>{{ $tipo->nombre_tipo_calle }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection