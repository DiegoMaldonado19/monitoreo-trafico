<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCalle extends Model
{
    protected $table = 'tipo_calle';
    protected $primaryKey = 'id_tipo_calle';
    public $timestamps = false;

    protected $fillable = ['nombre_tipo_calle'];
}
