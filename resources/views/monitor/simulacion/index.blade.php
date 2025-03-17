@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Simulación de Prueba {{ $prueba->id_prueba }}</h1>

    <!-- Botón para iniciar la simulación -->
    <button id="iniciarSimulacion" class="btn btn-primary">Realizar Simulación</button>
    <div id="simulacion" data-prueba-id="{{ $prueba->id_prueba }}">
        <!-- Aquí se renderizará la simulación -->
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Definir fetchData en el ámbito global
    window.fetchData = function() {
        const simulacionContainer = document.getElementById('simulacion');
        const pruebaId = simulacionContainer.getAttribute('data-prueba-id');

        fetch(`/monitor/simulacion/data/${pruebaId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                return response.json();
            })
            .then(data => {
                console.log('Datos recibidos:', data);
                renderSimulacion(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    };

    function renderSimulacion(data) {
        const simulacionContainer = document.getElementById('simulacion');
        simulacionContainer.innerHTML = '';

        const interseccion = document.createElement('div');
        interseccion.style.position = 'relative';
        interseccion.style.width = '400px';
        interseccion.style.height = '400px';
        interseccion.style.border = '2px solid black';

        data.flujos_vehiculares_prueba.forEach(flujo => {
            const semaforo = flujo.semaforo;
            const calle = semaforo.calle;

            const semaforoElement = document.createElement('div');
            semaforoElement.style.position = 'absolute';
            semaforoElement.style.backgroundColor = getSemaforoColor(flujo);
            semaforoElement.style.width = '20px';
            semaforoElement.style.height = '20px';
            semaforoElement.style.borderRadius = '50%';

            switch (semaforo.id_semaforo) {
                case 1:
                    semaforoElement.style.top = '0';
                    semaforoElement.style.left = '50%';
                    break;
                case 2:
                    semaforoElement.style.top = '50%';
                    semaforoElement.style.right = '0';
                    break;
                case 3:
                    semaforoElement.style.bottom = '0';
                    semaforoElement.style.left = '50%';
                    break;
                case 4:
                    semaforoElement.style.top = '50%';
                    semaforoElement.style.left = '0';
                    break;
            }

            interseccion.appendChild(semaforoElement);
        });

        simulacionContainer.appendChild(interseccion);
    }

    function getSemaforoColor(flujo) {
        const ahora = new Date();
        const tiempoTranscurrido = (ahora - new Date(flujo.fecha_hora)) / 1000;
        const cicloTotal = flujo.tiempo_verde + flujo.tiempo_amarillo + flujo.tiempo_rojo;
        const tiempoEnCiclo = tiempoTranscurrido % cicloTotal;

        if (tiempoEnCiclo < flujo.tiempo_verde) {
            return 'green';
        } else if (tiempoEnCiclo < flujo.tiempo_verde + flujo.tiempo_amarillo) {
            return 'yellow';
        } else {
            return 'red';
        }
    }

    // Asignar el evento de clic al botón
    document.addEventListener('DOMContentLoaded', function() {
        const boton = document.getElementById('iniciarSimulacion');
        if (boton) {
            boton.addEventListener('click', function() {
                fetchData();
            });
        }
    });
</script>
@endpush