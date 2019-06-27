<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $table="buses";
    protected $fillable=["codigo","empresa_id","numero_sillas","placa","categoria"];


}
