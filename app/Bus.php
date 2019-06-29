<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;

class Bus extends Model
{
    //
    protected $table="buses";
    protected $fillable=["codigo","empresa_id","numero_sillas","placa","categoria"];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

}
