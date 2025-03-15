@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Reporte</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $reporte->id_reporte }}</h5>
            <p class="card-text">Prueba: {{ $reporte->prueba->id_prueba }}</p>
            <p class="card-text">Fecha: {{ $reporte->fecha_hora }}</p>
            <a href="{{ route('supervisor.reportes.edit', $reporte->id_reporte) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection