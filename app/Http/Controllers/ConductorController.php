<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
Use App\Conductor;
Use App\Viaje;
use App\Ruta;
use App\Bus;
class ConductorController extends Controller
{


    public function index()
    {
        return view('conductor.inicio',["user"=>Auth::user()]);
    }

    public function consultaViajes(){
        //consultar los viajes del conductor.
        //traigamos el conductor_id del usuario
        $arrayorigendestino=array();
        $conductor=Conductor::where("user_id",Auth::user()->id)->first();
        $viajes=Viaje::where("conductor_id",$conductor->id)->get();
        //Necesito un array con el origen y el destino de cada viaje
        foreach ($viajes as $viaje){
            $ruta=Ruta::where("id",$viaje->ruta_id)->first();
            $muniorigen=$ruta->municipio_origen;
            $deparorigen=$ruta->departamento_origen;
            $munidestino=$ruta->municipio_destino;
            $depardestino=$ruta->departamento_destino;
            $origen=$muniorigen .", ". $deparorigen;
            $destino=$munidestino.", ".$depardestino;
            array_push($arrayorigendestino,[$origen,$destino]);

        }
        
        return view("conductor.listaviajes",["viajes"=>$viajes,"rutas"=>$arrayorigendestino,"nombre"=>strtoupper($conductor->nombre)]);
    }
}
