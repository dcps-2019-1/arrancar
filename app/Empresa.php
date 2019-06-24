<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Conductor;
use App\User;

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
}
