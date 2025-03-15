<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEstado extends Model
{
    protected $table = 'tipo_estado';
    protected $primaryKey = 'id_tipo_estado';
    public $timestamps = false;

    protected $fillable = ['tipo_estado'];
}
