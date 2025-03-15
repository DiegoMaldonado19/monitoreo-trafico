@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Calle</h1>
    <form action="{{ route('admin.calles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre_calle">Nombre de la Calle</label>
            <input type="text" name="nombre_calle" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="id_tipo_calle">Tipo de Calle</label>
            <select name="id_tipo_calle" class="form-control" required>
                @foreach($tiposCalle as $tipo)
                <option value="{{ $tipo->id_tipo_calle }}">{{ $tipo->nombre_tipo_calle }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection