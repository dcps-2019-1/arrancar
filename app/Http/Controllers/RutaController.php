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

        return view('empresa.registrar-ruta',['departamentos'=>$departamentos,"user"=>Auth::user()]);
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
            "departamento_origen"=>"required|exists:municipios,departamento",
            "municipio_origen"=>"required|exists:municipios,municipio",
            "departamento_destino"=>"required|exists:municipios,departamento",
            "municipio_destino"=>"required|exists:municipios,municipio",
            "codigo"=>['required', 'numeric', 'min:1', new CodigoNoRepetido],
        ]
        ,[
            "departamento_origen.required"=>"* El departamento de salida es obligatorio",
            "municipio_origen.required" => "* El municipio de salida es obligatorio",
            "departamento_destino.required" => "* El departamento de llegada es obligatorio",
            "municipio_destino.required" => "* El municipio de llegada es obligatorio",
            "departamento_origen.exists"=>" El departamento de salida no existe",
            "departamento_destino"=>" El departamento de llegada no existe",
            "codigo.required" => "* El código es obligatorio",
            "codigo.numeric"=>" El código debe ser un número",
            "codigo.min"=>" El código deber ser mayor a cero",
            "municipio_origen"=>" El municipio de salida no existe",
            "municipio_destino"=>" El municipio de llegada no existe",
        ]);
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $ruta2 = Ruta::where('municipio_origen', $datos["municipio_origen"])
            ->where('departamento_origen', $datos["departamento_origen"])
            ->where('municipio_destino', $datos["municipio_destino"])
            ->where('departamento_destino', $datos["departamento_destino"])
            ->where('empresa_id', $empresa->id)
            ->first();
        if ($ruta2) {
            return redirect()->back()->with('alert', 'Ruta ya existe en la base de datos');
        }
        $ruta = Ruta::create(['empresa_id'=>$empresa->id, "codigo"=>$datos["codigo"], "municipio_origen"=>$datos["municipio_origen"], "departamento_origen"=>$datos["departamento_origen"]
        , "municipio_destino"=>$datos["municipio_destino"], "departamento_destino"=>$datos["departamento_destino"]]);
        if ($ruta->wasRecentlyCreated == true) {
            return redirect()->back()->with('alert', 'Ruta agregada exitosamente');
        }
        return redirect("/empresa/registrar-ruta");    
    }
}
