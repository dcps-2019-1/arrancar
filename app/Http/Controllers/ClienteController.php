<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente.inicio',["user"=>Auth::user()]);
    }
}
