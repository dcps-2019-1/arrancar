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
            session(['viajeida' => $empresasviajeida]);
            session(['viajeregreso' => $empresasviajeregreso]);
            session(['viajeros' => $data["cantidad"]]);
            //dd(count(session("viajeida")));
            return view("cliente.mostrarviajes");
        }



    }

    public function compra(){
        $data=request()->validate(["ida"=>"exists:viajes,id","regreso"=>"exists:viajes,id"],
            ["ida.exists"=>"El viaje de ida no existe",
                "ida.required"=>"Ninguna viaje de ida seleccionado",
                "regreso.required"=>"Ningún viaje de regreso seleccionado",
                "regreso.exists"=>"El viaje de regreso no existe",
               ]);
        $ida=0;
        $regreso=0;
        //borro de la sesión
        request()->session()->forget(['viajeida', 'viajeregreso']);
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
            session(["ida"=>$ida]);
            session(["regreso"=>$regreso]);
            //viajeros sigue en session
            //dd(session("viajeros"));
            return(view("cliente.resumencompra"));


        }
        elseif(isset($data["ida"])){
            //viene ida
            $ida=Viaje::where("id",$data["ida"])->first();
            $rutaida=$ida->ruta;
            $ida=[$ida,$rutaida];
            session(["ida"=>$ida]);
            session(["regreso"=>$regreso]);
            return(view("cliente.resumencompra",["ida"=>$ida,"regreso"=>$regreso]));

        }
        else{

            //viene regreso
            $regreso=Viaje::where("id",$data["regreso"])->first();
            $rutaregreso=$regreso->ruta;
            $regreso=[$regreso,$rutaregreso];
            session(["ida"=>$ida]);
            session(["regreso"=>$regreso]);
            return(view("cliente.resumencompra",["regreso"=>$regreso,"ida"=>$ida]));

        }
        //


    }


    public  function finalizarCompra(){
        //$data=request();
        $data=request();
        $ida=session("ida");
        $regreso=session("regreso");
        //En 0 tengo el viaje, en 1 la ruta
        //dd($regreso[0]->id);

        if($ida!=null and $regreso!=null){


            $creartiquetedeida=Tiquete::create(["viaje_id"=>$ida[0]->id,"user_id"=>Auth::user()->id,"cantidad_puestos"=>session("viajeros")]);
            $creartiquetederegreso=Tiquete::create(["viaje_id"=>$regreso[0]->id,"user_id"=>Auth::user()->id,"cantidad_puestos"=>session("viajeros")]);
            //dd("ACA ESTOY");
            request()->session()->forget(['ida',"regreso","viajeros"]);
            return redirect()->route("consultar_viaje")->with('alert', 'TIQUETES COMPRADOS');

        }
        elseif($ida!=null){
            $creartiquetedeida=Tiquete::create(["viaje_id"=>$ida[0]->id,"user_id"=>Auth::user()->id,"cantidad_puestos"=>session("viajeros")]);
            request()->session()->forget(['ida',"regreso","viajeros"]);
            return redirect()->route("consultar_viaje")->with('alert', 'TIQUETES COMPRADOS');
        }
        else{

            $creartiquetederegreso=Tiquete::create(["viaje_id"=>$regreso[0]->id,"user_id"=>Auth::user()->id,"cantidad_puestos"=>session("viajeros")]);
            request()->session()->forget(['ida',"regreso","viajeros"]);
            return redirect()->route("consultar_viaje")->with('alert', 'TIQUETES COMPRADOS');
        }



    }
    public function historial(){
        $listatiquetes=Tiquete::where("user_id",Auth::user()->id)->get();
        $detalle=Array();
        //dd($listatiquetes);
        foreach ($listatiquetes as $tiquete){
            $viaje=$tiquete->viaje;
            $ruta=$viaje->ruta;
            //dd($tiquete);
            array_push($detalle,[$viaje,$ruta,$tiquete]);
        }
        //[x][0]->viaje
        //[x][1]->ruta

        return view("cliente.mostrarHistorial",["detalle"=>$detalle]);

    }

    public function cancelar(){
        $listatiquetes=Tiquete::where("user_id",Auth::user()->id)->get(); //obtengo todos los viajes del usuario, ahora busco
        //los que la fecha de viaje sea inferior a hoy.
        $posibles=Array();
        foreach ($listatiquetes as $tiquete){
            $viaje=$tiquete->viaje;
            $ruta=$viaje->ruta;
            $fecha=$viaje->fecha;
            if($fecha>date("Y-m-d")){
                //como el viaje no ha pasado, lo puedo agregar a la lista de cancelables
                array_push($posibles,[$tiquete,$viaje,$ruta]);
            }

        }
        //[x][0] es tiquete, [x][1] es viaje, [x][2] es ruta
        //dd($posibles[0][1]->id);
        return(view("cliente.posiblesCancelados",["posibles"=>$posibles]));

    }
    public function cancelarViaje($idtiquete){
        $tiquete=Tiquete::where("id",$idtiquete)->get();

        try {
            // Validate the value...
            $tiquete[0]->delete();
            return redirect()->back()->with('alert', 'Viaje cancelado');

        } catch (Exception $e) {
            //fljo altrntivo
            return redirect()->back()->with('alert', 'Viaje no pudo ser cancelado');
        }







    }


}
