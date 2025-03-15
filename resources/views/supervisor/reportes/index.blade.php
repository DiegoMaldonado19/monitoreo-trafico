@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Reportes</h1>
    <a href="{{ route('supervisor.reportes.create') }}" class="btn btn-primary">Generar Reporte</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prueba</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportes as $reporte)
            <tr>
                <td>{{ $reporte->id_reporte }}</td>
                <td>{{ $reporte->prueba->id_prueba }}</td>
                <td>{{ $reporte->fecha_hora }}</td>
                <td>
                    <a href="{{ route('supervisor.reportes.show', $reporte->id_reporte) }}" class="btn btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection