<?php

namespace App\Http\Controllers;


use App\Empresa;
use App\Rules\CodigoBus;
use Illuminate\Http\Request;
use App\Bus;
use File;
use Auth;
class BusController extends Controller
{
    //
    public function vistaRegistrar(){
        //obtengo id de empresa loggeada
        return view('empresa.registrar-bus',["title"=>"Registrar Bus","user"=>Auth::user()]);

    }

    public function registrarBuses(){
        //validaciones
        $datos=request();
        //eliminar el caracter intermedio
        $letras=substr($datos["placa"], 0, 3);
        $numeros=substr($datos["placa"], -3, 3);
        $placafin=strtoupper($letras).$numeros;
        $datos=request()["placa"]=$placafin;
        $datos=request()->validate(["placa"=> ["required","unique:buses,placa","regex:/[aA-zZ][aA-zZ][aA-zZ][\W|\s]{0,1}[0-9][0-9][0-9]/"],
            "codigo"=>["required","numeric","min:1", new CodigoBus],
            "numero_sillas"=>"required|numeric|min:1",
            "categoria"=>"required|string"],["placa.unique"=>"La placa del bus ya existe en la base de datos",
            "placa.required"=>"La placa es requerida",
            "placa.regex"=>"La placa no tiene un formato valido",
            "codigo.numeric"=>"El código debe ser numerico",
            "codigo.required"=>"El codigo es requerido",
            "codigo.min"=>"El codigo debe ser un número positivo",
            "numero_sillas.numeric"=>"El número de sillas debe ser númerico",
            "numero_sillas.required"=>"El número de sillas es requerido",
            "numero_sillas.min"=>"El número de sillas debe ser mayor a 0",
            "categoria.string"=>"La categoría debe ser un String",
            "categoria.required"=>"La categoría es requerida",]);
        //obtener id de la empresa:
        //modificar la placa, para que sea acorde con la BD
        //dd(strlen($datos["placa"]));



        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $bus = Bus::create(["placa"=>$placafin,"codigo"=>$datos["codigo"],"numero_sillas"=>$datos["numero_sillas"],"empresa_id"=>$empresa->id,"categoria"=>$datos["categoria"]]);
        if ($bus->wasRecentlyCreated == true) {
            return redirect()->back()->with('alert', 'Bus agregado exitosamente');
        }
        return redirect("/empresa/registrar-bus");

    }
}
