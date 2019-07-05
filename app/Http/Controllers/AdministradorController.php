<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AdministradorController extends Controller
{
    public function index()
    {
        return view('administrador.inicio',["user"=>Auth::user()]);
    }
}
