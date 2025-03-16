<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEstado extends Model
{
    use HasFactory;

    protected $table = 'tipo_estado';
    protected $primaryKey = 'id_tipo_estado';
    public $timestamps = false;

    protected $fillable = [
        'tipo_estado',
    ];

    public function pruebasEstados()
    {
        return $this->hasMany(PruebaEstado::class, 'id_tipo_estado');
    }
}