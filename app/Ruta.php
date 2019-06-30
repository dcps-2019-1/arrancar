<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;

class Ruta extends Model
{
    protected $table = 'rutas';
    protected $guarded = [];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
