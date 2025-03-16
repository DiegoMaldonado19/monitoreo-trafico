<!-- resources/views/admin/calles/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Calle</h1>
    <form method="POST" action="{{ route('admin.calles.store') }}">
        @csrf
        <div class="form-group">
            <label for="nombre_calle">Nombre de la Calle</label>
            <input type="text" class="form-control" id="nombre_calle" name="nombre_calle" required>
        </div>
        <div class="form-group">
            <label for="id_tipo_calle">Tipo de Calle</label>
            <select class="form-control" id="id_tipo_calle" name="id_tipo_calle" required>
                @foreach ($tiposCalle as $tipoCalle)
                    <option value="{{ $tipoCalle->id_tipo_calle }}">{{ $tipoCalle->nombre_tipo_calle }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
@endsection