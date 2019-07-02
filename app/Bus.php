<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;
use App\Viaje;

class Bus extends Model
{
    //
    protected $table="buses";
    protected $fillable=["codigo","empresa_id","numero_sillas","placa","categoria"];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
