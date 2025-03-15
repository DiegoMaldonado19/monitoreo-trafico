<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false;

    protected $fillable = ['nombre_usuario', 'contrasena', 'id_rol'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }
}
