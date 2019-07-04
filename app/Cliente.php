<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Cliente extends Model
{
    protected $table = "clientes";
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
