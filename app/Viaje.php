<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;
use App\Conductor;

class Viaje extends Model
{
    protected $guarded = [];
    protected $table = 'viajes';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function conductor()
    {
        return $this->belongsTo(Conductor::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
