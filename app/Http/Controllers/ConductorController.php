<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index()
    {
        return view('conductor.inicio');
    }
}
