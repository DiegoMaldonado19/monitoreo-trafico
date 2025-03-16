<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'tipo_vehiculo';
    protected $primaryKey = 'id_tipo_vehiculo';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo_vehiculo',
    ];

    // Relación con los detalles del flujo vehicular
    public function flujosVehicularesDetalle()
    {
        return $this->hasMany(FlujoVehicularDetalle::class, 'id_tipo_vehiculo');
    }
}