<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    protected $table = 'calle';
    protected $primaryKey = 'id_calle';
    public $timestamps = false;

    protected $fillable = ['nombre_calle', 'id_tipo_calle'];

    public function tipoCalle()
    {
        return $this->belongsTo(TipoCalle::class, 'id_tipo_calle');
    }
}
