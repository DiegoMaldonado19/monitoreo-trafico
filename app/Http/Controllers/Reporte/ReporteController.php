<?php

namespace App\Http\Controllers\Reporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\Prueba;
use App\Models\ReporteDetalle;
use DB;

class ReporteController extends Controller
{
    // Mostrar la lista de reportes
    public function indexReportes()
    {
        $reportes = Reporte::with('prueba')->get();
        return view('supervisor.reportes.index', compact('reportes'));
    }

    // Generar un nuevo reporte
    public function generarReporte()
    {
        // Ejecutar la consulta SQL para obtener los datos del flujo vehicular
        $resultados = DB::select('
            SELECT 
                fv.fecha_hora,
                tc.nombre_tipo_calle,
                c.nombre_calle,
                tv.nombre_tipo_vehiculo,
                fvd.cantidad_vehiculos,
                fv.velocidad_promedio
            FROM 
                flujo_vehicular fv
            JOIN 
                flujo_vehicular_detalle fvd ON fv.id_flujo = fvd.id_flujo
            JOIN 
                tipo_vehiculo tv ON fvd.id_tipo_vehiculo = tv.id_tipo_vehiculo
            JOIN 
                semaforo s ON fv.id_semaforo = s.id_semaforo
            JOIN 
                calle c ON s.id_calle = c.id_calle
            JOIN 
                tipo_calle tc ON c.id_tipo_calle = tc.id_tipo_calle
            ORDER BY 
                fv.fecha_hora DESC;
        ');

        // Crear un nuevo reporte
        $reporte = Reporte::create([
            'id_prueba' => null, // O asignar una prueba si es necesario
            'fecha_hora' => now(),
        ]);

        // Guardar los detalles del reporte
        foreach ($resultados as $resultado) {
            $reporte->detalles()->create([
                'id_tipo_vehiculo' => $resultado->id_tipo_vehiculo,
                'cantidad_vehiculos' => $resultado->cantidad_vehiculos,
                'velocidad_promedio' => $resultado->velocidad_promedio,
            ]);
        }

        return redirect()->route('supervisor.reportes.index')->with('success', 'Reporte generado correctamente.');
    }

    // Mostrar los detalles de un reporte específico
    public function showReporte($id)
    {
        $reporte = Reporte::with('detalles.tipoVehiculo')->findOrFail($id);
        return view('supervisor.reportes.show', compact('reporte'));
    }
}