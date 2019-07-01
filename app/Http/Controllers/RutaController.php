<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipio;
use DB;
use Auth;
use App\Ruta;
use App\Empresa;
use App\Rules\CodigoNoRepetido;

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
        $datos = request()->validate([
            "departamento-origen"=>"required|exists:municipios,departamento",
            "municipio-origen"=>"required|exists:municipios,municipio",
            "departamento-destino"=>"required|exists:municipios,departamento",
            "municipio_destino"=>"required|exists:municipios,municipio",
            "codigo"=>['required', 'numeric', 'min:1', new CodigoNoRepetido],
        ]
        ,[
            "departamento-origen.required"=>"* El departamento de salida es obligatorio",
            "municipio-origen.required" => "* El municipio de salida es obligatorio",
            "departamento-destino.required" => "* El departamento de llegada es obligatorio",
            "municipio_destino.required" => "* El municipio de llegada es obligatorio",
            "departamento-origen.exists"=>" El departamento de salida no existe",
            "departamento-destino"=>" El departamento de llegada no existe",
            "codigo.required" => "* El código es obligatorio",
            "codigo.numeric"=>" El código debe ser un número",
            "codigo.min"=>" El código deber ser mayor a cero",
            "municipio-origen"=>" El municipio de salida no existe",
            "municipio_destino"=>" El municipio de llegada no existe",
        ]);
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        Ruta::create(['empresa_id'=>$empresa->id, "codigo"=>$datos["codigo"], "municipio-origen"=>$datos["municipio-origen"], "departamento-origen"=>$datos["departamento-origen"]
        , "municipio_destino"=>$datos["municipio_destino"], "departamento-destino"=>$datos["departamento-destino"]]);
        return redirect("/empresa/registrar-ruta");    
    }
}
