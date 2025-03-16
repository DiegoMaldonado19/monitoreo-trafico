<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\Calle;
use App\Models\Prueba;

class SupervisorController extends Controller
{
    // Mostrar lista de reportes
    public function indexReportes()
    {
        $reportes = Reporte::with('prueba')->get();
        return view('supervisor.reportes.index', compact('reportes'));
    }

    // Generar un nuevo reporte
    public function generarReporte()
    {
        // Lógica para generar reportes basados en las consultas de "Consultas-2.sql"
        // ...

        return redirect()->route('supervisor.reportes.index')->with('success', 'Reporte generado correctamente');
    }

    // Mostrar lista de calles y avenidas
    public function indexCalles()
    {
        $calles = Calle::with('tipoCalle')->get();
        return view('supervisor.calles.index', compact('calles'));
    }

    // Agregar una nueva calle o avenida
    public function storeCalle(Request $request)
    {
        $request->validate([
            'nombre_calle' => 'required',
            'id_tipo_calle' => 'required|exists:tipo_calle,id_tipo_calle',
        ]);

        Calle::create($request->all());
        return redirect()->route('supervisor.calles.index')->with('success', 'Calle/avenida agregada correctamente');
    }
}
