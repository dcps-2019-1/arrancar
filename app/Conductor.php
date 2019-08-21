<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;
use App\User;
use App\Viaje;

class Conductor extends Model
{
    protected $table = 'conductores';
    protected $guarded = [];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }
}
