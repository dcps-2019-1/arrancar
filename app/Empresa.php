<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Conductor;
use App\User;
use App\Bus;
use App\Ruta;
use App\Mantenimiento;

class Empresa extends Model
{
    protected $table = 'empresas';
    protected $guarded = [];

    public function conductores()
    {
        return $this->hasMany(Conductor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }

    public function rutas()
    {
        return $this->hasMany(Ruta::class);
    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class);
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class);
    }
}
