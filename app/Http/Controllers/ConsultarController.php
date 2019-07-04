<?php

namespace App\Http\Controllers;

use App\Bus;
use App\Conductor;
use App\Empresa;
use App\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class ConsultarController extends Controller
{

    public function consultas(){
        return view('empresa.consultar-informacion',["user"=>Auth::user()]);
    }

    public function listarConductores(){

        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $conductores = Conductor::where('empresa_id', $empresa->id)->get();
        return view('empresa.ListaConductores',['empresa'=> $empresa,"user"=>Auth::user()]);
    }

    public function listarBuses(){
        //obtengo id de empresa loggeada
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $buses = Bus::where('empresa_id', $empresa->id)->get();
        return view('empresa.ListaBuses',["buses"=>$buses,"title"=>"Registrar Buses","user"=>Auth::user()]);
    }


    public function listarMantenimientos(){
        //obtengo id de empresa loggeada
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $mantenimientos = Mantenimiento::where('empresa_id', $empresa->id)->get();
        return view('empresa.ListaMantenimientos',['mantenimientos'=> $mantenimientos,"user"=>Auth::user()]);
    }



}







