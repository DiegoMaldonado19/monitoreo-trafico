<?php

namespace App\Http\Controllers\Monitor;

use App\Http\Controllers\Controller;
use App\Models\Prueba;
use App\Models\TipoPrueba;
use App\Models\Semaforo;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function index()
    {
        $pruebas = Prueba::all();
        return view('monitor.pruebas.index', compact('pruebas'));
    }

    public function create()
    {
        $tiposPrueba = TipoPrueba::all();
        $semaforos = Semaforo::all();
        return view('monitor.pruebas.create', compact('tiposPrueba', 'semaforos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:usuario,id_usuario',
            'fecha_hora_inicio' => 'required|date',
            'fecha_hora_fin' => 'required|date',
            'id_tipo_prueba' => 'required|exists:tipo_prueba,id_tipo_prueba',
        ]);

        Prueba::create($request->all());
        return redirect()->route('monitor.pruebas.index')->with('success', 'Prueba creada exitosamente.');
    }

    public function show(Prueba $prueba)
    {
        return view('monitor.pruebas.show', compact('prueba'));
    }
}
