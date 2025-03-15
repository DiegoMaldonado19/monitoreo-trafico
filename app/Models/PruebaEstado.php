<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PruebaEstado extends Model
{
    protected $table = 'prueba_estado';
    protected $primaryKey = 'id_prueba_estado';
    public $timestamps = false;

    protected $fillable = ['id_prueba', 'id_tipo_estado', 'id_tipo_vehiculo', 'cantidad_vehiculos', 'velocidad_promedio'];

    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'id_prueba');
    }

    public function tipoEstado()
    {
        return $this->belongsTo(TipoEstado::class, 'id_tipo_estado');
    }

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}
