<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\PruebaEstado;
use App\Models\Prueba;
use App\Models\TipoEstado;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;

class PruebaEstadoController extends Controller
{
    public function index()
    {
        $pruebasEstado = PruebaEstado::all();
        return view('supervisor.pruebas_estado.index', compact('pruebasEstado'));
    }

    public function create()
    {
        $pruebas = Prueba::all();
        $tiposEstado = TipoEstado::all();
        $tiposVehiculo = TipoVehiculo::all();
        return view('supervisor.pruebas_estado.create', compact('pruebas', 'tiposEstado', 'tiposVehiculo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_prueba' => 'required|exists:prueba,id_prueba',
            'id_tipo_estado' => 'required|exists:tipo_estado,id_tipo_estado',
            'id_tipo_vehiculo' => 'required|exists:tipo_vehiculo,id_tipo_vehiculo',
            'cantidad_vehiculos' => 'required|integer',
            'velocidad_promedio' => 'required|numeric',
        ]);

        PruebaEstado::create($request->all());
        return redirect()->route('supervisor.pruebas_estado.index')->with('success', 'Estado de prueba registrado exitosamente.');
    }
}