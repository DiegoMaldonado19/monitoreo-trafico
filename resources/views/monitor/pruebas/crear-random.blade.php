<!-- resources/views/monitor/pruebas/crear-random.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Generar Prueba Aleatoria</h1>
    <form method="POST" action="{{ route('monitor.pruebas.cargar-random') }}">
        @csrf
        <div class="form-group">
            <label for="num_flujos">Número de Flujos Vehiculares</label>
            <input type="number" class="form-control" id="num_flujos" name="num_flujos" min="1" required>
        </div>
        <div class="form-group">
            <label for="num_detalles">Detalles por Flujo</label>
            <input type="number" class="form-control" id="num_detalles" name="num_detalles" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Generar</button>
    </form>
</div>
@endsection