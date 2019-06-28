<?php

namespace App\Http\Controllers;


use App\Empresa;
use Illuminate\Http\Request;
use App\User;
use App\Bus;
use Auth;
class BusController extends Controller
{
    //
    public function listarBuses(){
        //obtengo id de empresa loggeada
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $buses = Bus::where('empresa_id', $empresa->id)->get();
        return view('empresa.registrar-bus',["buses"=>$buses,"title"=>"Registrar Buses"]);

    }

    public function registrarBuses(){
        //validaciones
        $datos=request()->validate(["placa"=>"unique:buses,placa",
            "codigo"=>"numeric",
            "numero_sillas"=>"numeric",
            "categoria"=>"string"],["placa.unique"=>"La placa del bus ya existe en la base de datos","codigo.numeric"=>"El código debe ser numerico",
            "numero_sillas.numeric"=>"El número de sillas debe ser númerico","categoria.string"=>"La categoría debe ser un String"]);
        //obtener id de la empresa:
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        Bus::create(["placa"=>$datos["placa"],"codigo"=>$datos["codigo"],"numero_sillas"=>$datos["numero_sillas"],"empresa_id"=>$empresa->id,"categoria"=>$datos["categoria"]]);
        return redirect("/empresa/registrar-bus");

    }
}
