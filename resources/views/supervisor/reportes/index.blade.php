<!-- resources/views/supervisor/reportes/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reportes Generados</h1>
    <a href="{{ route('supervisor.reportes.generar') }}" class="btn btn-primary mb-3">Generar Nuevo Reporte</a>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Prueba</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $reporte)
                <tr>
                    <td>{{ $reporte->fecha_hora }}</td>
                    <td>{{ $reporte->prueba->id_prueba }}</td>
                    <td>
                        <a href="{{ route('supervisor.reportes.show', $reporte->id_reporte) }}" class="btn btn-info">Ver Detalles</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection