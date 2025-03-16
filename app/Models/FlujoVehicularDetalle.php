<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlujoVehicularDetalle extends Model
{
    use HasFactory;

    protected $table = 'flujo_vehicular_detalle';
    protected $primaryKey = 'id_flujo_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_flujo',
        'id_tipo_vehiculo',
        'cantidad_vehiculos',
    ];

    // Relación con el flujo vehicular
    public function flujoVehicular()
    {
        return $this->belongsTo(FlujoVehicular::class, 'id_flujo');
    }

    // Relación con el tipo de vehículo
    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}