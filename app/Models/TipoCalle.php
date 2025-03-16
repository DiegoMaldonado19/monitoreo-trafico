<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCalle extends Model
{
    use HasFactory;

    protected $table = 'tipo_calle';
    protected $primaryKey = 'id_tipo_calle';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipo_calle',
    ];

    // Relación con las calles
    public function calles()
    {
        return $this->hasMany(Calle::class, 'id_tipo_calle');
    }
}