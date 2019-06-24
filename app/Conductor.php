<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empresa;
use App\User;

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
        return $this->belongsTo(User::class);
    }
}
