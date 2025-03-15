// tiempo_real.blade.php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Simulación en Tiempo Real</h1>
    <div id="flujo-vehicular">
        <!-- Aquí se mostrarán los datos en tiempo real -->
    </div>
</div>

<script>
    // Ejemplo de actualización en tiempo real usando AJAX
    setInterval(function() {
        fetch('/api/flujo-vehicular')
            .then(response => response.json())
            .then(data => {
                document.getElementById('flujo-vehicular').innerHTML = JSON.stringify(data);
            });
    }, 5000); // Actualizar cada 5 segundos
</script>
@endsection