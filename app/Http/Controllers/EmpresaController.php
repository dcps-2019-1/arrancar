<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conductor;
use App\Empresa;
use Auth;

class EmpresaController extends Controller
{
    public function index()
    {
        return view('empresa.inicio');
    }

    public function listarConductores()
    {
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $conductores = Conductor::where('empresa_id', $empresa->id)->get();
        return view('empresa.registrar-conductor')->with('conductores', $conductores);
    }
}
