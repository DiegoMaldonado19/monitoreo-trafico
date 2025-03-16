<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    use HasFactory;

    protected $table = 'prueba';
    protected $primaryKey = 'id_prueba';
    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'id_tipo_prueba',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function tipoPrueba()
    {
        return $this->belongsTo(TipoPrueba::class, 'id_tipo_prueba');
    }

    public function estados()
    {
        return $this->hasMany(PruebaEstado::class, 'id_prueba');
    }
}