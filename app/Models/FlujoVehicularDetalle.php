<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlujoVehicularDetalle extends Model
{
    protected $table = 'flujo_vehicular_detalle';
    protected $primaryKey = 'id_flujo_detalle';
    public $timestamps = false;

    protected $fillable = ['id_flujo', 'id_tipo_vehiculo', 'cantidad_vehiculos'];

    public function flujoVehicular()
    {
        return $this->belongsTo(FlujoVehicular::class, 'id_flujo');
    }

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}
