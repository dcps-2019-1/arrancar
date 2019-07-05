<?php

namespace App\Rules;
use Auth;
use Illuminate\Contracts\Validation\Rule;
use App\Bus;
use App\empresa;
class CodigoBus implements Rule
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
        //atributte, representa el valor del campo, o sea el codigo. Value el valor que se le envia,
        //el que viene por el post
        $idempresa=Auth::user()->id;
        //tengo la empresa
        $empresa=Empresa::where("user_id",$idempresa)->first();
        //id de la empresa en empresas
        $idreal=$empresa->id;
        $busesdeempresa=Bus::where("empresa_id","$idreal")->where("codigo","=",$value)->get();
        //dd($busesdeempresa->first());
        if($busesdeempresa->first()==null){
            return true;
        }
        else{
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
        return 'El código del bus ya existe en la empresa';
    }
}
