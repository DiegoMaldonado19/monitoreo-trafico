<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';
    public $timestamps = false;

    protected $fillable = [
        'id_prueba',
        'fecha_hora',
    ];

    // Relación con la prueba
    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'id_prueba');
    }

    // Relación con los detalles del reporte
    public function detalles()
    {
        return $this->hasMany(ReporteDetalle::class, 'id_reporte');
    }
}