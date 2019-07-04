<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Conductor;
use App\Empresa;
use App\Administrador;
use App\Cliente;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empresas()
    {
        return $this->hasMany(Empresa::class);
    }

    public function conductores()
    {
        return $this->hasMany(Conductor::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

    public function administradores()
    {
        return $this->hasMany(Administrador::class);
    }

    public function hasRol($rol)
    {
        if ($this->rol == $rol){
            return true;
        }
        return false;
    }
}
