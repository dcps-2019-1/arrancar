<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Viaje;
use App\Ruta;
use PhpParser\Node\Expr\Array_;

class ClienteController extends Controller
{
    public function index()
    {
        return view('cliente.inicio',["user"=>Auth::user()]);
    }
    public function mostrar()
        {
            $departamentos = DB::table('municipios')
                ->select('departamento')
                ->distinct()
                ->get();
            return view('cliente.consultarViaje',["user"=>Auth::user(),"departamentos"=>$departamentos]);
        }
    public function fetch(Request $request)
    {
        $select = 'departamento';
        $value = $request->get('value');
        $dependent2 = 'municipio';
        $data = DB::table('municipios')
            ->select('municipio')
            ->where($select, $value)
            ->get();
        $output = '<option value="">' . ucfirst($dependent2) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->municipio . '">' . $row->municipio . '</option>';
        }
        echo $output;
    }


    public function consulta(){
        $data=request()->validate(["fecha_salida"=>"required|date|after_or_equal:today|before_or_equal:fecha_regreso",
            "fecha_regreso"=>"required|date|after_or_equal:fecha_salida","departamento_origen"=>"required",
            "municipio_origen"=>"required","departamento_destino"=>"required","municipio_destino"=>"required","cantidad"=>"required|numeric|min:1"],
            ["fecha_salida.required"=>"La fecha de salida es requerida",
                "fecha_salida.date"=>"La fecha de salida debe tener formato de fecha",
                "fecha_salida.after_or_equal"=>"La fecha de salida debe ser hoy o después de hoy",
                "fecha_salida.before_or_equal"=>"La fecha de salida debe ser antes de la fecha de regreso",
                "fecha_regreso.required"=>"La fecha de regreso es requerida",
                "fecha_regreso.date"=>"La fecha de regreso debe tener formato de fecha",

                "fecha_regreso.after_or_equal"=>"La fecha de regreso debe ser después de la fecha de salida",
                "departamento_origen.required"=>"El departamento de origen es requerido",
                "municipio_origen.required"=>"El municipio de origen es requerido",
                "departamento_destino.required"=>"El departamento de destino es requerido",
                "municipio_destino.required"=>"El municipio de destino es requerido",
                "cantidad.required"=>"La cantidad de viajeros es requerida",
                "cantidad.numeric"=>"La cantidad de viajeros debe ser un número",
                "cantidad.min"=>"La cantidad de viajeros debe ser minímo 1",

                ]);
        //Tengo que buscar si algún viaje cumple con los criterios de busqueda:
        //Primero tengo que buscar en rutas, los trayectos
        $rutaida=Ruta::where("municipio_origen",$data["municipio_origen"])->where("municipio_destino",$data["municipio_destino"])->get();
        $empresasviajeida=array();
        //Itero sobre las empresas que prestan el viaje de ida, buscando la fecha seleccionada en los viajes
        foreach($rutaida as $ida){
            $viaje=Viaje::where("ruta_id",$ida->id)->where("fecha",$data["fecha_salida"])->where("puestos_disponibles",">=",$data["cantidad"])->get();
            if(count($viaje)>0) {
                array_push($empresasviajeida, [$viaje,$ida]);
            }
        }
        $rutavenida=Ruta::where("municipio_origen",$data["municipio_destino"])->where("municipio_destino",$data["municipio_origen"])->get();
        $empresasviajeregreso=array();
        //Itero sobre las empresas que prestan el viaje de ida, buscando la fecha seleccionada en los viajes
        foreach($rutavenida as $venida){
            $viaje=Viaje::where("ruta_id",$venida->id)->where("fecha",$data["fecha_regreso"])->where("puestos_disponibles",">=",$data["cantidad"])->get();
            if(count($viaje)>0) {
                array_push($empresasviajeregreso, [$viaje,$venida]);
            }
        }
    //en ambos arrays ya tengo los posibles viajes de ia y de regreso.

        if(count($empresasviajeida)==0 and count($empresasviajeregreso)==0){
            return redirect()->back()->with('alert', 'No se encontraron viajes que cumplan la busqueda o tengan la cantidad de puestos deseados');
        }
        else{
            //en [x][0][0]->está el viaje
            //en [x][1]-> esta la ruta
            //dd(count($empresasviajeregreso));
            return view("cliente.mostrarviajes",["viajeida"=>$empresasviajeida,"viajeregreso"=>$empresasviajeregreso,"viajeros"=>$data["cantidad"]]);
        }



    }

    public function compra(){
        return view("cliente.comprar");

        //FALTA PROGRAMAR ESTA LÓGICA DE COMPRADO
    }




}
