<!-- resources/views/monitor/pruebas/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pruebas en Sistema</h1>
    <a href="{{ route('monitor.pruebas.crear-json') }}" class="btn btn-primary">Crear Prueba desde JSON</a>
    <a href="{{ route('monitor.pruebas.crear-random') }}" class="btn btn-success">Generar Prueba Aleatoria</a>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Tipo de Prueba</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pruebas as $prueba)
                <tr>
                    <td>{{ $prueba->fecha_hora_inicio }}</td>
                    <td>{{ $prueba->fecha_hora_fin }}</td>
                    <td>{{ $prueba->tipoPrueba->nombre_tipo_prueba }}</td>
                    <td>
                        <button class="btn btn-secondary btn-simular" data-id="{{ $prueba->id_prueba }}">Simular</button>
                        <a href="{{ route('monitor.pruebas.show', $prueba->id_prueba) }}" class="btn btn-info">Ver Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-simular').forEach(btn => {
        btn.addEventListener('click', function() {
            const pruebaId = this.dataset.id;
            // Lógica de simulación aquí
            alert('Simulación de prueba ID: ' + pruebaId);
        });
    });
</script>
@endpush