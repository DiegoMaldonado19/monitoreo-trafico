@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Flujos Vehiculares</h1>
    <a href="{{ route('monitor.flujo-vehicular.create') }}" class="btn btn-primary">Registrar Flujo</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Semáforo</th>
                <th>Fecha y Hora</th>
                <th>Velocidad Promedio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($flujos as $flujo)
            <tr>
                <td>{{ $flujo->id_flujo }}</td>
                <td>{{ $flujo->semaforo->id_semaforo }}</td>
                <td>{{ $flujo->fecha_hora }}</td>
                <td>{{ $flujo->velocidad_promedio }}</td>
                <td>
                    <a href="{{ route('monitor.flujo-vehicular.show', $flujo->id_flujo) }}" class="btn btn-info">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection