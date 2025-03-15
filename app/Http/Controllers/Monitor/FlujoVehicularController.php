<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use App\Models\FlujoVehicular;
use App\Models\Semaforo;
use Illuminate\Http\Request;

class FlujoVehicularController extends Controller
{
    public function index()
    {
        $flujos = FlujoVehicular::all();
        return view('monitor.flujo_vehicular.index', compact('flujos'));
    }

    public function create()
    {
        $semaforos = Semaforo::all();
        return view('monitor.flujo_vehicular.create', compact('semaforos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_semaforo' => 'required|exists:semaforo,id_semaforo',
            'fecha_hora' => 'required|date',
            'velocidad_promedio' => 'required|numeric',
        ]);

        FlujoVehicular::create($request->all());
        return redirect()->route('monitor.flujo_vehicular.index')->with('success', 'Flujo vehicular registrado exitosamente.');
    }
}
