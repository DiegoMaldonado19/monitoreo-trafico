<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use App\Models\Prueba;
use App\Models\FlujoVehicularPrueba;
use App\Models\FlujoVehicularPruebaDetalle;
use App\Models\Semaforo;
use Illuminate\Http\Request;

class SimulacionController extends Controller
{
    public function index($id)
    {
        $prueba = Prueba::with(['flujosVehicularesPrueba.detallesFlujoVehicularPrueba', 'flujosVehicularesPrueba.semaforo.calle'])->findOrFail($id);

        return view('monitor.simulacion.index', compact('prueba'));
    }

    public function getData($id)
    {
        $prueba = Prueba::with(['flujosVehicularesPrueba.detallesFlujoVehicularPrueba', 'flujosVehicularesPrueba.semaforo.calle'])->findOrFail($id);

        return response()->json($prueba);
    }
}