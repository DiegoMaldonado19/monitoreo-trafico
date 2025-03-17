<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    // Métodos para gestionar reportes
    public function indexReportes()
    {
        return view('supervisor.reportes.index');
    }

    public function consultaResumenTrafico()
    {
        $resultados = DB::select("
            SELECT 
                fvp.fecha_hora,
                tc.nombre_tipo_calle,
                c.nombre_calle,
                tv.nombre_tipo_vehiculo,
                fvpd.cantidad_vehiculos,
                fvp.velocidad_promedio
            FROM 
                flujo_vehicular_prueba fvp
            JOIN 
                flujo_vehicular_prueba_detalle fvpd ON fvp.id_flujo_prueba = fvpd.id_flujo_prueba
            JOIN 
                tipo_vehiculo tv ON fvpd.id_tipo_vehiculo = tv.id_tipo_vehiculo
            JOIN 
                semaforo s ON fvp.id_semaforo = s.id_semaforo
            JOIN 
                calle c ON s.id_calle = c.id_calle
            JOIN 
                tipo_calle tc ON c.id_tipo_calle = tc.id_tipo_calle
            ORDER BY 
                fvp.fecha_hora DESC;
        ");
        return response()->json($resultados);
    }

    public function consultaIteracionesMonitor()
    {
        $resultados = DB::select("
            SELECT 
                u.nombre_usuario AS monitor,
                p.fecha_hora_inicio,
                p.fecha_hora_fin,
                TIMESTAMPDIFF(SECOND, p.fecha_hora_inicio, p.fecha_hora_fin) AS tiempo_invertido_segundos,
                tp.nombre_tipo_prueba
            FROM 
                prueba p
            JOIN 
                usuario u ON p.id_usuario = u.id_usuario
            JOIN 
                tipo_prueba tp ON p.id_tipo_prueba = tp.id_tipo_prueba
            WHERE 
                u.id_rol = (SELECT id_rol FROM rol WHERE nombre_rol = 'Monitor')
            ORDER BY 
                p.fecha_hora_inicio DESC;
        ");
        return response()->json($resultados);
    }

    public function consultaFlujoSemaforo()
    {
        $resultados = DB::select("
            SELECT 
                s.id_semaforo,
                c.nombre_calle,
                s.tiempo_verde,
                s.tiempo_amarillo,
                s.tiempo_rojo,
                fvp.fecha_hora,
                fvp.velocidad_promedio,
                tv.nombre_tipo_vehiculo,
                fvpd.cantidad_vehiculos
            FROM 
                semaforo s
            JOIN 
                flujo_vehicular_prueba fvp ON s.id_semaforo = fvp.id_semaforo
            JOIN 
                flujo_vehicular_prueba_detalle fvpd ON fvp.id_flujo_prueba = fvpd.id_flujo_prueba
            JOIN 
                tipo_vehiculo tv ON fvpd.id_tipo_vehiculo = tv.id_tipo_vehiculo
            JOIN 
                calle c ON s.id_calle = c.id_calle
            ORDER BY 
                s.id_semaforo, fvp.fecha_hora DESC;
        ");
        return response()->json($resultados);
    }

    public function consultaCantidadPruebas()
    {
        $resultados = DB::select("
            SELECT 
                u.nombre_usuario AS monitor,
                COUNT(p.id_prueba) AS cantidad_pruebas
            FROM 
                prueba p
            JOIN 
                usuario u ON p.id_usuario = u.id_usuario
            WHERE 
                u.id_rol = (SELECT id_rol FROM rol WHERE nombre_rol = 'Monitor')
            GROUP BY 
                u.nombre_usuario
            ORDER BY 
                cantidad_pruebas DESC;
        ");
        return response()->json($resultados);
    }

    public function consultaCantidadArchivos()
    {
        $resultados = DB::select("
            SELECT 
                u.nombre_usuario AS monitor,
                COUNT(p.id_prueba) AS cantidad_archivos_cargados
            FROM 
                prueba p
            JOIN 
                usuario u ON p.id_usuario = u.id_usuario
            JOIN 
                tipo_prueba tp ON p.id_tipo_prueba = tp.id_tipo_prueba
            WHERE 
                u.id_rol = (SELECT id_rol FROM rol WHERE nombre_rol = 'Monitor')
                AND tp.nombre_tipo_prueba = 'archivo'
            GROUP BY 
                u.nombre_usuario
            ORDER BY 
                cantidad_archivos_cargados DESC;
        ");
        return response()->json($resultados);
    }

    public function consultaTiempoPromedio()
    {
        $resultados = DB::select("
            SELECT 
                u.nombre_usuario AS monitor,
                AVG(TIMESTAMPDIFF(SECOND, p.fecha_hora_inicio, p.fecha_hora_fin)) AS tiempo_promedio_segundos
            FROM 
                prueba p
            JOIN 
                usuario u ON p.id_usuario = u.id_usuario
            WHERE 
                u.id_rol = (SELECT id_rol FROM rol WHERE nombre_rol = 'Monitor')
            GROUP BY 
                u.nombre_usuario
            ORDER BY 
                tiempo_promedio_segundos DESC;
        ");
        return response()->json($resultados);
    }

    public function consultaPruebasIntervalo()
    {
        $resultados = DB::select("
            SELECT 
                u.nombre_usuario AS monitor,
                COUNT(p.id_prueba) AS cantidad_pruebas,
                MIN(p.fecha_hora_inicio) AS fecha_inicio_intervalo,
                MAX(p.fecha_hora_fin) AS fecha_fin_intervalo
            FROM 
                prueba p
            JOIN 
                usuario u ON p.id_usuario = u.id_usuario
            WHERE 
                u.id_rol = (SELECT id_rol FROM rol WHERE nombre_rol = 'Monitor')
                AND p.fecha_hora_inicio BETWEEN '2023-01-01 00:00:00' AND '2023-12-31 23:59:59'
            GROUP BY 
                u.nombre_usuario
            ORDER BY 
                cantidad_pruebas DESC;
        ");
        return response()->json($resultados);
    }
}