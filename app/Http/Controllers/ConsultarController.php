<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Conductor;
use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ConsultarController extends Controller
{

    public function consultas(){
        return view('empresa.consultar-informacion');
    }

    public function listarConductores(){

        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $conductores = Conductor::where('empresa_id', $empresa->id)->get();
        return view('empresa.ListaConductores')->with('empresa', $empresa);}

    public function listarBuses(){
        //obtengo id de empresa loggeada
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $buses = Bus::where('empresa_id', $empresa->id)->get();
        return view('empresa.ListaBuses',["buses"=>$buses,"title"=>"Registrar Buses"]);
    }






}







