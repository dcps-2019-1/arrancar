<?php

namespace App\Rules;
use Auth;
use App\Ruta;

use Illuminate\Contracts\Validation\Rule;

class CodigoNoRepetido implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rutas = Ruta::where('empresa_id', Auth::user()->id)->where('codigo', $value)->first();
        if ($rutas == null) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Codigo ya asignado en la base de datos';
    }
}
