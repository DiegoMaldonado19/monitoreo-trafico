<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use App\Models\FlujoVehicular;
use App\Models\Prueba;
use App\Models\Semaforo;
use App\Models\TipoPrueba;
use Illuminate\Http\Request;

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
}