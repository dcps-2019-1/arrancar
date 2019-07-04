<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;

class Mantenimiento extends Model
{
    //
    protected $table="mantenimientos";
    protected  $fillable=["bus_id","empresa_id","fecha_entrada","fecha_salida"];
    public $timestamps = false;

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
