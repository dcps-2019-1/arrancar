<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Cliente extends Model
{

    protected $table = "clientes";
    protected $fillable=["cedula","nombre","medio_pago","contacto_emergencia","user_id"];
    protected $guarded = [];
    public $timestamps = false;
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
