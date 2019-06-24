<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Conductor;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $guarded = [];

    public function conductores()
    {
        return $this->hasMany(Conductor::class);
    }
}
