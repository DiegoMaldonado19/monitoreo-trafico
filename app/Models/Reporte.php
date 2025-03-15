<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';
    public $timestamps = false;

    protected $fillable = ['id_prueba', 'fecha_hora'];

    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'id_prueba');
    }
}
