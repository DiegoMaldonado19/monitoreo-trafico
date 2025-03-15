<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calle;
use App\Models\TipoCalle;
use Illuminate\Http\Request;

class CalleController extends Controller
{
    public function index()
    {
        $calles = Calle::all();
        return view('admin.calles.index', compact('calles'));
    }

    public function create()
    {
        $tiposCalle = TipoCalle::all();
        return view('admin.calles.create', compact('tiposCalle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_calle' => 'required',
            'id_tipo_calle' => 'required|exists:tipo_calle,id_tipo_calle',
        ]);

        Calle::create($request->all());
        return redirect()->route('admin.calles.index')->with('success', 'Calle creada exitosamente.');
    }

    public function edit(Calle $calle)
    {
        $tiposCalle = TipoCalle::all();
        return view('admin.calles.edit', compact('calle', 'tiposCalle'));
    }

    public function update(Request $request, Calle $calle)
    {
        $request->validate([
            'nombre_calle' => 'required',
            'id_tipo_calle' => 'required|exists:tipo_calle,id_tipo_calle',
        ]);

        $calle->update($request->all());
        return redirect()->route('admin.calles.index')->with('success', 'Calle actualizada exitosamente.');
    }

    public function destroy(Calle $calle)
    {
        $calle->delete();
        return redirect()->route('admin.calles.index')->with('success', 'Calle eliminada exitosamente.');
    }
}
