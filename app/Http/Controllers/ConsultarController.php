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
        $conductores = $empresa->conductores;
        return view('empresa.ListaConductores',['conductores'=> $conductores]);
    }

    public function listarBuses(){
        //obtengo id de empresa loggeada
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $buses = $empresa->buses;
        return view('empresa.ListaBuses',["buses"=>$buses,"title"=>"Registrar Buses","user"=>Auth::user()]);
    }


    public function listarMantenimientos(){
        //obtengo id de empresa loggeada
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $mantenimientos = $empresa->mantenimientos;
        return view('empresa.ListaMantenimientos',['mantenimientos'=> $mantenimientos]);
    }

    public function listarRutas()
    {
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $rutas = $empresa->rutas;
        return view('empresa.ListaRutas', ['rutas' => $rutas]);
    }

    public function listarViajes()
    {
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $viajes = $empresa->viajes;
        return view('empresa.ListaViajes', ['viajes' => $viajes]);
    }

}







