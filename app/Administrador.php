<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Administrador extends Model
{
    protected $table = "administradores";
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
