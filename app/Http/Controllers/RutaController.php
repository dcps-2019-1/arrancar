<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipio;
use DB;

class RutaController extends Controller
{
    public function index()
    {
        $departamentos = Municipio::groupBy('departamento')->get();

        return view('empresa.registrar-ruta')->with('departamentos', $departamentos);
    }

    public function fetch(Request $request)
    {
        $select = 'departamento';
        $value = $request->get('value');
        $dependent2 = 'municipio';
        $data = DB::table('municipios')
            ->where($select, $value)
            ->groupBy($dependent2)
            ->get();
        $output = '<option value="">' . ucfirst($dependent2) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->$dependent2 . '">' . $row->$dependent2 . '</option>';
        }
        echo $output;
    }
}
