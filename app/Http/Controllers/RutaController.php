<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipio;
use DB;
use Auth;
use App\Ruta;
use App\Empresa;

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

    public function registrarRuta()
    {
        $datos = request();

        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        Ruta::create(['empresa_id'=>$empresa->id, "codigo"=>$datos["codigo"], "municipio-origen"=>$datos["municipio-origen"], "departamento-origen"=>$datos["departamento-origen"]
        , "municipio_destino"=>$datos["municipio_destino"], "departamento-destino"=>$datos["departamento-destino"]]);
        return redirect("/empresa/registrar-ruta");    
    }
}
