<!-- resources/views/supervisor/reportes/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container dashboard-container">
    <h1>Dashboard de Consultas</h1>
    <div class="dashboard-buttons">
        <button class="btn btn-primary" onclick="fetchData('consultaResumenTrafico')">Resumen de Tráfico Vehicular</button>
        <button class="btn btn-primary" onclick="fetchData('consultaIteracionesMonitor')">Iteraciones y Tiempos por Monitor</button>
        <button class="btn btn-primary" onclick="fetchData('consultaFlujoSemaforo')">Flujo Vehicular según Semáforo</button>
        <button class="btn btn-primary" onclick="fetchData('consultaCantidadPruebas')">Cantidad de Pruebas Realizadas</button>
        <button class="btn btn-primary" onclick="fetchData('consultaCantidadArchivos')">Cantidad de Archivos Cargados</button>
        <button class="btn btn-primary" onclick="fetchData('consultaTiempoPromedio')">Tiempo Promedio por Sesión</button>
        <button class="btn btn-primary" onclick="fetchData('consultaPruebasIntervalo')">Pruebas en Intervalo de Tiempo</button>
    </div>
    <div id="resultados" class="mt-3"></div>
</div>

<script>
    function fetchData(endpoint) {
        fetch(`/supervisor/${endpoint}`)
            .then(response => response.json())
            .then(data => {
                let table = '<table class="dashboard-table"><thead><tr>';
                if (data.length > 0) {
                    Object.keys(data[0]).forEach(key => {
                        table += `<th>${key}</th>`;
                    });
                    table += '</tr></thead><tbody>';
                    data.forEach(row => {
                        table += '<tr>';
                        Object.values(row).forEach(value => {
                            table += `<td>${value}</td>`;
                        });
                        table += '</tr>';
                    });
                    table += '</tbody></table>';
                } else {
                    table = '<p>No hay datos disponibles.</p>';
                }
                document.getElementById('resultados').innerHTML = table;
            })
            .catch(error => console.error('Error:', error));
    }
</script>
@endsection