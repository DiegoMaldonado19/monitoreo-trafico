<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporteDetalle extends Model
{
    use HasFactory;

    protected $table = 'reporte_detalle';
    protected $primaryKey = 'id_reporte_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_reporte',
        'id_tipo_vehiculo',
        'cantidad_vehiculos',
        'velocidad_promedio',
    ];

    // Relación con el reporte
    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'id_reporte');
    }

    // Relación con el tipo de vehículo
    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}
