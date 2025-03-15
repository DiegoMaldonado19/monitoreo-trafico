<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlujoVehicularPruebaDetalle extends Model
{
    protected $table = 'flujo_vehicular_prueba_detalle';
    protected $primaryKey = 'id_flujo_prueba_detalle';
    public $timestamps = false;

    protected $fillable = ['id_flujo_prueba', 'id_tipo_vehiculo', 'cantidad_vehiculos'];

    public function flujoVehicularPrueba()
    {
        return $this->belongsTo(FlujoVehicularPrueba::class, 'id_flujo_prueba');
    }

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}
