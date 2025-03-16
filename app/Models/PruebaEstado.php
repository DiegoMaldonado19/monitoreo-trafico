<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PruebaEstado extends Model
{
    use HasFactory;

    protected $table = 'prueba_estado';
    protected $primaryKey = 'id_prueba_estado';
    public $timestamps = false;

    protected $fillable = [
        'id_prueba',
        'id_tipo_estado',
        'id_tipo_vehiculo',
        'cantidad_vehiculos',
        'velocidad_promedio',
    ];

    // Relación con la prueba
    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'id_prueba');
    }

    // Relación con el tipo de estado
    public function tipoEstado()
    {
        return $this->belongsTo(TipoEstado::class, 'id_tipo_estado');
    }

    // Relación con el tipo de vehículo
    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class, 'id_tipo_vehiculo');
    }
}