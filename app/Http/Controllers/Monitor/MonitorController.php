<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use App\Models\FlujoVehicularPrueba;
use App\Models\FlujoVehicularPruebaDetalle;
use App\Models\Prueba;
use App\Models\Semaforo;
use App\Models\TipoPrueba;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class MonitorController extends Controller
{
    // Métodos para gestionar el flujo vehicular
    public function indexFlujoVehicular()
    {
        $flujos = FlujoVehicular::with('semaforo')->get();
        return view('monitor.flujo-vehicular.index', compact('flujos'));
    }

    public function createFlujoVehicular()
    {
        $semaforos = Semaforo::all();
        return view('monitor.flujo-vehicular.create', compact('semaforos'));
    }

    public function storeFlujoVehicular(Request $request)
    {
        $request->validate([
            'id_semaforo' => 'required|exists:semaforo,id_semaforo',
            'fecha_hora' => 'required|date',
            'velocidad_promedio' => 'required|numeric|min:0',
        ]);

        FlujoVehicular::create($request->all());

        return redirect()->route('monitor.flujo-vehicular.index')->with('success', 'Flujo vehicular registrado correctamente.');
    }

    public function editFlujoVehicular($id)
    {
        $flujo = FlujoVehicular::findOrFail($id);
        $semaforos = Semaforo::all();
        return view('monitor.flujo-vehicular.edit', compact('flujo', 'semaforos'));
    }

    public function updateFlujoVehicular(Request $request, $id)
    {
        $request->validate([
            'id_semaforo' => 'required|exists:semaforo,id_semaforo',
            'fecha_hora' => 'required|date',
            'velocidad_promedio' => 'required|numeric|min:0',
        ]);

        $flujo = FlujoVehicular::findOrFail($id);
        $flujo->update($request->all());

        return redirect()->route('monitor.flujo-vehicular.index')->with('success', 'Flujo vehicular actualizado correctamente.');
    }

    public function destroyFlujoVehicular($id)
    {
        $flujo = FlujoVehicular::findOrFail($id);
        $flujo->delete();

        return redirect()->route('monitor.flujo-vehicular.index')->with('success', 'Flujo vehicular eliminado correctamente.');
    }

    // Métodos para gestionar pruebas
    public function indexPruebas()
    {
        $pruebas = Prueba::where('id_usuario', auth()->id())->with('tipoPrueba')->get();
        return view('monitor.pruebas.index', compact('pruebas'));
    }

    public function createPrueba()
    {
        $tiposPrueba = TipoPrueba::all();
        return view('monitor.pruebas.create', compact('tiposPrueba'));
    }

    public function storePrueba(Request $request)
    {
        $request->validate([
            'id_tipo_prueba' => 'required|exists:tipo_prueba,id_tipo_prueba',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
        ]);

        Prueba::create([
            'id_usuario' => auth()->id(),
            'id_tipo_prueba' => $request->id_tipo_prueba,
            'fecha_hora_inicio' => $request->fecha_hora_inicio,
            'fecha_hora_fin' => $request->fecha_hora_fin,
        ]);

        return redirect()->route('monitor.pruebas.index')->with('success', 'Prueba creada correctamente.');
    }

    public function editPrueba($id)
    {
        $prueba = Prueba::findOrFail($id);
        $tiposPrueba = TipoPrueba::all();
        return view('monitor.pruebas.edit', compact('prueba', 'tiposPrueba'));
    }

    public function updatePrueba(Request $request, $id)
    {
        $request->validate([
            'id_tipo_prueba' => 'required|exists:tipo_prueba,id_tipo_prueba',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date|after:fecha_hora_inicio',
        ]);

        $prueba = Prueba::findOrFail($id);
        $prueba->update($request->all());

        return redirect()->route('monitor.pruebas.index')->with('success', 'Prueba actualizada correctamente.');
    }

    public function destroyPrueba($id)
    {
        $prueba = Prueba::findOrFail($id);
        $prueba->delete();

        return redirect()->route('monitor.pruebas.index')->with('success', 'Prueba eliminada correctamente.');
    }

    // Mostrar formulario para cargar JSON
    public function crearJson()
    {
        return view('monitor.pruebas.crear-json');
    }

    // Mostrar formulario para generar datos aleatorios
    public function crearRandom()
    {
        return view('monitor.pruebas.crear-random');
    }

    // Procesar JSON
    public function cargarJson(Request $request)
    {
        $request->validate([
            'archivo_json' => 'required|file|mimes:json|max:2048'
        ]);

        try {
            $json = json_decode(file_get_contents($request->file('archivo_json')->path()), true);
            
            return DB::transaction(function() use ($json) {
                // Crear prueba
                $prueba = Prueba::create([
                    'id_usuario' => auth()->id(),
                    'id_tipo_prueba' => 1, // Tipo "archivo"
                    'fecha_hora_inicio' => $json['prueba']['fecha_hora_inicio'],
                    'fecha_hora_fin' => $json['prueba']['fecha_hora_fin']
                ]);

                // Insertar flujos vehiculares
                foreach ($json['flujo_vehicular_prueba'] as $flujo) {
                    $flujoPrueba = FlujoVehicularPrueba::create([
                        'id_prueba' => $prueba->id_prueba,
                        'id_semaforo' => $flujo['id_semaforo'],
                        'fecha_hora' => $flujo['fecha_hora'],
                        'velocidad_promedio' => $flujo['velocidad_promedio']
                    ]);

                    foreach ($flujo['flujo_vehicular_prueba_detalle'] as $detalle) {
                        FlujoVehicularPruebaDetalle::create([
                            'id_flujo_prueba' => $flujoPrueba->id_flujo_prueba,
                            'id_tipo_vehiculo' => $detalle['id_tipo_vehiculo'],
                            'cantidad_vehiculos' => $detalle['cantidad_vehiculos']
                        ]);
                    }
                }

                return redirect()->route('monitor.pruebas.index')->with('success', 'Prueba cargada desde JSON correctamente');
            });

        } catch (\Exception $e) {
            return back()->withErrors('Error al procesar el archivo: ' . $e->getMessage());
        }
    }

    // Generar datos aleatorios
    public function cargarRandom(Request $request)
    {
        $request->validate([
            'num_flujos' => 'required|integer|min:1',
            'num_detalles' => 'required|integer|min:1'
        ]);

        try {
            $faker = Faker::create();
            $semaforos = Semaforo::pluck('id_semaforo')->toArray();
            $tiposVehiculo = TipoVehiculo::pluck('id_tipo_vehiculo')->toArray();

            return DB::transaction(function() use ($faker, $semaforos, $tiposVehiculo, $request) {
                // Crear prueba
                $prueba = Prueba::create([
                    'id_usuario' => auth()->id(),
                    'id_tipo_prueba' => 2, // Tipo "random"
                    'fecha_hora_inicio' => now(),
                    'fecha_hora_fin' => now()->addHour()
                ]);

                // Generar flujos vehiculares
                for ($i = 0; $i < $request->num_flujos; $i++) {
                    $flujoPrueba = FlujoVehicularPrueba::create([
                        'id_prueba' => $prueba->id_prueba,
                        'id_semaforo' => $faker->randomElement($semaforos),
                        'fecha_hora' => $faker->dateTimeBetween($prueba->fecha_hora_inicio, $prueba->fecha_hora_fin),
                        'velocidad_promedio' => $faker->randomFloat(1, 20, 100)
                    ]);

                    // Generar detalles
                    for ($j = 0; $j < $request->num_detalles; $j++) {
                        FlujoVehicularPruebaDetalle::create([
                            'id_flujo_prueba' => $flujoPrueba->id_flujo_prueba,
                            'id_tipo_vehiculo' => $faker->randomElement($tiposVehiculo),
                            'cantidad_vehiculos' => $faker->numberBetween(1, 20)
                        ]);
                    }
                }

                return redirect()->route('monitor.pruebas.index')->with('success', 'Prueba generada aleatoriamente');
            });

        } catch (\Exception $e) {
            return back()->withErrors('Error al generar datos: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // Obtener la prueba con sus relaciones
        $prueba = Prueba::with(['tipoPrueba', 'flujosVehicularesPrueba.detallesFlujoVehicularPrueba'])->findOrFail($id);

        // Pasar los datos a la vista
        return view('monitor.pruebas.show', compact('prueba'));
    }
}