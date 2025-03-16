<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Reporte;
use App\Models\ReporteDetalle;
use App\Models\TipoVehiculo;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    // Métodos para gestionar reportes
    public function indexReportes()
    {
        $reportes = Reporte::with('prueba')->get();
        return view('supervisor.reportes.index', compact('reportes'));
    }

    public function generarReporte()
    {
        $reporte = Reporte::create([
            'id_prueba' => null,
            'fecha_hora' => now(),
        ]);

        $reporte->detalles()->create([
            'id_tipo_vehiculo' => 1,
            'cantidad_vehiculos' => 50,
            'velocidad_promedio' => 60.5,
        ]);

        return redirect()->route('supervisor.reportes.index')->with('success', 'Reporte generado correctamente.');
    }

    public function showReporte($id)
    {
        $reporte = Reporte::with('detalles.tipoVehiculo')->findOrFail($id);
        return view('supervisor.reportes.show', compact('reporte'));
    }
}