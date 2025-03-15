<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPrueba extends Model
{
    protected $table = 'tipo_prueba';
    protected $primaryKey = 'id_tipo_prueba';
    public $timestamps = false;

    protected $fillable = ['nombre_tipo_prueba'];
}
