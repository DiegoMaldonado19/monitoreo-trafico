<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlujoVehicularPruebaDetalle extends Model
{
    use HasFactory;

    protected $table = 'flujo_vehicular_prueba_detalle';
    protected $primaryKey = 'id_flujo_prueba_detalle';
    public $timestamps = false;

    protected $fillable = [
        'id_flujo_prueba',
        'id_tipo_vehiculo',
        'cantidad_vehiculos',
    ];

    // Relación con el flujo vehicular durante las pruebas
    public function flujoVehicularPrueba()
    {
        return $this->belongsTo(FlujoVehicularPrueba::class, 'id_flujo_prueba');
    }

    // Relación con el tipo de vehículo
    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}