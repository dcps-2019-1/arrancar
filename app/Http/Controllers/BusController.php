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
}
