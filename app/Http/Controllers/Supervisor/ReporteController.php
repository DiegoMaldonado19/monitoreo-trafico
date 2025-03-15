<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\Prueba;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index()
    {
        $reportes = Reporte::all();
        return view('supervisor.reportes.index', compact('reportes'));
    }

    public function create()
    {
        $pruebas = Prueba::all();
        return view('supervisor.reportes.create', compact('pruebas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_prueba' => 'required|exists:prueba,id_prueba',
            'fecha_hora' => 'required|date',
        ]);

        Reporte::create($request->all());
        return redirect()->route('supervisor.reportes.index')->with('success', 'Reporte generado exitosamente.');
    }

    public function show(Reporte $reporte)
    {
        return view('supervisor.reportes.show', compact('reporte'));
    }
}