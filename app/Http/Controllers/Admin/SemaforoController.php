<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Semaforo;
use App\Models\Calle;
use Illuminate\Http\Request;

class SemaforoController extends Controller
{
    public function index()
    {
        $semaforos = Semaforo::all();
        return view('admin.semaforos.index', compact('semaforos'));
    }

    public function create()
    {
        $calles = Calle::all();
        return view('admin.semaforos.create', compact('calles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_calle' => 'required|exists:calle,id_calle',
            'tiempo_verde' => 'required|integer',
            'tiempo_amarillo' => 'required|integer',
            'tiempo_rojo' => 'required|integer',
        ]);

        Semaforo::create($request->all());
        return redirect()->route('admin.semaforos.index')->with('success', 'Semáforo creado exitosamente.');
    }

    public function edit(Semaforo $semaforo)
    {
        $calles = Calle::all();
        return view('admin.semaforos.edit', compact('semaforo', 'calles'));
    }

    public function update(Request $request, Semaforo $semaforo)
    {
        $request->validate([
            'id_calle' => 'required|exists:calle,id_calle',
            'tiempo_verde' => 'required|integer',
            'tiempo_amarillo' => 'required|integer',
            'tiempo_rojo' => 'required|integer',
        ]);

        $semaforo->update($request->all());
        return redirect()->route('admin.semaforos.index')->with('success', 'Semáforo actualizado exitosamente.');
    }

    public function destroy(Semaforo $semaforo)
    {
        $semaforo->delete();
        return redirect()->route('admin.semaforos.index')->with('success', 'Semáforo eliminado exitosamente.');
    }
}
