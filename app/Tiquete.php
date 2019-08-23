<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiquete extends Model
{
    //
    protected $table="tiquetes";
    protected $fillable=["user_id","cantidad_puestos","viaje_id"];
    public $timestamps = false;

    public function viaje(){
        return $this->belongsTo(Viaje::class,"viaje_id","id");
    }
}
