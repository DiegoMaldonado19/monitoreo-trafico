<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoPrueba extends Model
{
    use HasFactory;

    protected $table = 'tipo_prueba';
    protected $primaryKey = 'id_tipo_prueba';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo_prueba',
    ];

    public function pruebas()
    {
        return $this->hasMany(Prueba::class, 'id_tipo_prueba');
    }
}