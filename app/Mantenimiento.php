<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    //
    protected $table="mantenimientos";
    protected  $fillable=["bus_id","fecha_entrada","fecha_salida"];
    public $timestamps = false;
}
