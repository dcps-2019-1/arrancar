<?php

namespace App\Http\Controllers;

use Auth;
use App\Conductor;
use App\Empresa;
use App\Ruta;
use App\Bus;
use Illuminate\Http\Request;

class ViajeController extends Controller
{
    public function listarRutas(){
        $empresa = Empresa::where('user_id', Auth::id())->first();
        return view('empresa.programar-viaje')->with('empresa', $empresa);
    }

    public function registrarViajes(){

    }
}
