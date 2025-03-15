@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de la Calle</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $calle->id_calle }}</h5>
            <p class="card-text">Nombre: {{ $calle->nombre_calle }}</p>
            <p class="card-text">Tipo de Calle: {{ $calle->tipoCalle->nombre_tipo_calle }}</p>
            <a href="{{ route('admin.calles.edit', $calle->id_calle) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection