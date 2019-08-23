<?php

namespace App\Http\Controllers;
use App\Tiquete;
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
        $data=request()->validate(["ida"=>"exists:viajes,id","regreso"=>"exists:viajes,id","cantidad_viajeros"=>"required|numeric|min:1"],
            ["ida.exists"=>"El viaje de ida no existe",
                "ida.required"=>"Ninguna ida seleccionado",
                "regreso.required"=>"Ningún regreso seleccionao",
                "regreso.exists"=>"El viaje de regreso no existe",
                "cantidad_viajeros.required"=>"La cantidad de viajeros es requerida",
                "cantidad_viajeros.numeric"=>"La cantidad de viajeros debe ser númerica",
                "cantidad_viajeros.min"=>"La cantidad de viajeros debe ser minímo 1"]);
        $ida=0;
        $regreso=0;

        if(isset($data["ida"]) and isset($data["regreso"])){
          //viene ida y regreso
            $ida=Viaje::where("id",$data["ida"])->first();
            $regreso=Viaje::where("id",$data["regreso"])->first();
            //$rutaida=Ruta::where("id",$ida->ruta_id);
            $rutaida=$ida->ruta;
            $rutaregreso=$regreso->ruta;
            $ida=[$ida,$rutaida];
            $regreso=[$regreso,$rutaregreso];
            //con 0 entro a viaje, con 1 a ruta
            //dd($ida[0]->fecha);
            return(view("cliente.resumencompra",["ida"=>$ida,"regreso"=>$regreso,"puestos"=>$data["cantidad_viajeros"]]));


        }
        elseif(isset($data["ida"])){
            //viene ida
            $ida=Viaje::where("id",$data["ida"])->first();
            $rutaida=$ida->ruta;
            $ida=[$ida,$rutaida];
            return(view("cliente.resumencompra",["ida"=>$ida,"regreso"=>$regreso,"puestos"=>$data["cantidad_viajeros"]]));

        }
        else{

            //viene regreso
            $regreso=Viaje::where("id",$data["regreso"])->first();
            $rutaregreso=$regreso->ruta;
            $regreso=[$regreso,$rutaregreso];
            return(view("cliente.resumencompra",["regreso"=>$regreso,"ida"=>$ida,"puestos"=>$data["cantidad_viajeros"]]));

        }
        //


    }


    public  function finalizarCompra(){
        //$data=request();
        $data=request()->validate(["ida"=>"exists:viajes,id","regreso"=>"exists:viajes,id","puestos"=>"numeric|min:1"],
            ["ida.exists"=>"El viaje seleccionado no existe","regreso.exists"=>"El viaje de regreso no existe",
                "puestos.min"=>"La cantidad de puestos debe ser mínimo 1","puestos.numeric"=>"La cantida de puestos debe ser numerico"]);
        if(isset($data["ida"]) and isset($data["regreso"])){

            $creartiquetedeida=Tiquete::create(["viaje_id"=>$data["ida"],"user_id"=>Auth::user()->id,"cantidad_puestos"=>$data["puestos"]]);
            $creartiquetederegreso=Tiquete::create(["viaje_id"=>$data["regreso"],"user_id"=>Auth::user()->id,"cantidad_puestos"=>$data["puestos"]]);
            return redirect()->route("consultar_viaje")->with('alert', 'TIQUETES COMPRADOS');

        }
        elseif(isset($data["ida"])){
            $creartiquetedeida=Tiquete::create(["viaje_id"=>$data["ida"],"user_id"=>Auth::user()->id,"cantidad_puestos"=>$data["puestos"]]);
            //dd($creartiquetedeida);
            return redirect()->route("consultar_viaje")->with('alert', 'TIQUETES COMPRADOS');
        }
        else{
            $creartiquetederegreso=Tiquete::create(["viaje_id"=>$data["regreso"],"user_id"=>Auth::user()->id,"cantidad_puestos"=>$data["puestos"]]);
            return redirect()->route("consultar_viaje")->with('alert', 'TIQUETES COMPRADOS');
        }



    }


}
