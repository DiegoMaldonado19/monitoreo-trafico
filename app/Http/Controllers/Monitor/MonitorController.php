<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FlujoVehicular;
use App\Models\FlujoVehicularDetalle;
use App\Models\Prueba;
use App\Models\TipoPrueba;

class MonitorController extends Controller
{
    // Mostrar formulario para cargar flujo vehicular desde JSON
    public function showCargarFlujoJson()
    {
        return view('monitor.flujo-vehicular.cargar-json');
    }

    // Procesar la carga de flujo vehicular desde JSON
    public function cargarFlujoJson(Request $request)
    {
        $request->validate([
            'archivo_json' => 'required|file|mimes:json',
        ]);

        $jsonData = json_decode(file_get_contents($request->file('archivo_json')->getPathname()), true);

        // Lógica para guardar los datos del JSON en la base de datos
        // ...

        return redirect()->route('monitor.flujo-vehicular.index')->with('success', 'Flujo vehicular cargado desde JSON');
    }

    // Generar flujo vehicular de manera aleatoria
    public function generarFlujoAleatorio()
    {
        // Lógica para generar datos aleatorios y guardarlos en la base de datos
        // ...

        return redirect()->route('monitor.flujo-vehicular.index')->with('success', 'Flujo vehicular generado aleatoriamente');
    }

    // Mostrar lista de pruebas realizadas
    public function indexPruebas()
    {
        $pruebas = Prueba::where('id_usuario', auth()->id())->with('tipoPrueba')->get();
        return view('monitor.pruebas.index', compact('pruebas'));
    }
}
