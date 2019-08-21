<?php

namespace App;

use App\Conductor;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(Conductor::class,"empresa_id","id");
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }

    public function buses()
    {
        return $this->hasMany(Bus::class,"empresa_id","id");
    }

    public function rutas()
    {
        return $this->hasMany(Ruta::class,"empresa_id","id");
    }

    public function viajes()
    {
        return $this->hasMany(Viaje::class,"empresa_id","id");
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class,"empresa_id","id");
    }

    public function borrado(){
        foreach ($this->viajes as $viaje){
            $viaje->delete();
        }
        foreach ($this->rutas as $ruta){
            $ruta->delete();
        }

        foreach ($this->mantenimientos as $mantenimiento){
            $mantenimiento->delete();
        }
        foreach ($this->buses as $bus){
            $bus->delete();
        }
        foreach ($this->conductores as $conductor){
            $borrarconductor=Conductor::where("id",$conductor->id)->first();
            $conductor->delete();
            $borrarconductor->user->delete();

        }

        //$empresa=Empresa::where("id",$this->id)->first();
        //$enusers=$empresa->user;
        //$empresa->delete();
        //$enusers->delete();


        //$this->user()->delete();
    }
}
