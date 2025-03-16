<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlujoVehicular extends Model
{
    use HasFactory;

    protected $table = 'flujo_vehicular';
    protected $primaryKey = 'id_flujo';
    public $timestamps = false;

    protected $fillable = [
        'id_semaforo',
        'fecha_hora',
        'velocidad_promedio',
    ];

    // Relación con el semáforo
    public function semaforo()
    {
        return $this->belongsTo(Semaforo::class, 'id_semaforo');
    }

    // Relación con los detalles del flujo vehicular
    public function detalles()
    {
        return $this->hasMany(FlujoVehicularDetalle::class, 'id_flujo');
    }
}