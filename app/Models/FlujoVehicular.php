<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlujoVehicular extends Model
{
    protected $table = 'flujo_vehicular';
    protected $primaryKey = 'id_flujo';
    public $timestamps = false;

    protected $fillable = ['id_semaforo', 'fecha_hora', 'velocidad_promedio'];

    public function semaforo()
    {
        return $this->belongsTo(Semaforo::class, 'id_semaforo');
    }
}
