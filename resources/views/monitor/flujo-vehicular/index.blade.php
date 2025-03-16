<!-- resources/views/monitor/flujo-vehicular/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Flujo Vehicular</h1>
    <a href="{{ route('monitor.flujo-vehicular.cargar-json') }}" class="btn btn-primary mb-3">Cargar desde JSON</a>
    <a href="{{ route('monitor.flujo-vehicular.generar-aleatorio') }}" class="btn btn-secondary mb-3">Generar Aleatorio</a>
</div>
@endsection