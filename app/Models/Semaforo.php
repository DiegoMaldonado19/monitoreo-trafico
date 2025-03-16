<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semaforo extends Model
{
    use HasFactory;

    protected $table = 'semaforo';
    protected $primaryKey = 'id_semaforo';
    public $timestamps = false;

    protected $fillable = [
        'id_calle',
        'tiempo_verde',
        'tiempo_amarillo',
        'tiempo_rojo',
    ];

    // Relación con la calle
    public function calle()
    {
        return $this->belongsTo(Calle::class, 'id_calle');
    }

    // Relación con el flujo vehicular
    public function flujosVehiculares()
    {
        return $this->hasMany(FlujoVehicular::class, 'id_semaforo');
    }
}