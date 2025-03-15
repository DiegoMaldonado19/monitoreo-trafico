<?php

// SimulacionController.php
namespace App\Http\Controllers\Simulaciones;

use Illuminate\Http\Request;
use App\Models\FlujoVehicular;
use App\Models\FlujoVehicularDetalle;
use App\Http\Controllers\Controller;

class SimulacionController extends Controller
{
    public function cargarJson(Request $request)
    {
        if ($request->hasFile('archivo_json')) {
            $archivo = $request->file('archivo_json');
            $datos = json_decode(file_get_contents($archivo->getRealPath()), true);

            // Procesar los datos y guardar en la base de datos
            foreach ($datos as $dato) {
                $flujo = FlujoVehicular::create([
                    'id_semaforo' => $dato['id_semaforo'],
                    'fecha_hora' => now(),
                    'velocidad_promedio' => $dato['velocidad_promedio'],
                ]);

                foreach ($dato['detalles'] as $detalle) {
                    FlujoVehicularDetalle::create([
                        'id_flujo' => $flujo->id_flujo,
                        'id_tipo_vehiculo' => $detalle['id_tipo_vehiculo'],
                        'cantidad_vehiculos' => $detalle['cantidad_vehiculos'],
                    ]);
                }
            }

            return redirect()->route('simulaciones.index')->with('success', 'Datos cargados exitosamente.');
        }

        return redirect()->route('simulaciones.index')->with('error', 'No se ha seleccionado un archivo.');
    }
}