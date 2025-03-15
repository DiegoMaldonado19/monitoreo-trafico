<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlujoVehicularPrueba extends Model
{
    protected $table = 'flujo_vehicular_prueba';
    protected $primaryKey = 'id_flujo_prueba';
    public $timestamps = false;

    protected $fillable = ['id_prueba', 'id_semaforo', 'fecha_hora', 'velocidad_promedio'];

    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'id_prueba');
    }

    public function semaforo()
    {
        return $this->belongsTo(Semaforo::class, 'id_semaforo');
    }
}
