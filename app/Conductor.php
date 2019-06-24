<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;

class Conductor extends Model
{
    protected $table = 'conductores';
    protected $guarded = [];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
