<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Bus;
use App\User;
use App\Mantenimiento;
use App\Empresa;
class MantenimientoController extends Controller
{
    //
    public function listar()
    {
        //Se deben listar todos los buses de la compañia, para seleccionar los que están disponibles para
        //hacerles mantenimiento. Usando el empresa_id de la tabla buses, que está relacionado con el id de usuario con
        //rol 2 en la tabla users.
        $idDeEmpresaEnusuarios = Auth::user()->id;
        $idDeEmpresaEnEmpresas = Empresa::where("user_id", $idDeEmpresaEnusuarios)->first();
        //buscar los buses que le pertenezcan a esa empresa y estén disponibles
        //No olvidar el get!
        $buses=Bus::where("empresa_id","=",$idDeEmpresaEnEmpresas->id)
            ->where("estado","disponible")->get();

        return view("empresa.programar-mantenimiento",["buses"=>$buses,"user"=>Auth::user()]);
}

    public function createMantenimiento(){
        //validaciones
        $datos=request();
        //eliminar el caracter intermedio
        $letras=substr($datos["placa"], 0, 3);
        $numeros=substr($datos["placa"], -3, 3);
        $placafin=strtoupper($letras).$numeros;
        $datos=request()["placa"]=$placafin;
        $datos=request()->validate(["placa"=> ["required","exists:buses,placa","regex:/[aA-zZ][aA-zZ][aA-zZ][\W|\s]{0,1}[0-9][0-9][0-9]/"],
            "fecha_entrada"=>"required|date|after_or_equal:today|before_or_equal:fecha_salida",
            "fecha_salida"=>"required|date|after_or_equal:fecha_entrada|after:today"],[
            "placa.required"=>"La placa es requerida",
            "placa.regex"=>"La placa no tiene un formato valido",
            "placa.exists"=>"La placa no existe en la base de datos",
            "fecha_entrada.required"=>"La fecha de entrada es requerida",
            "fecha_entrada.date"=>"Se debe especificar un formato de fecha",
            "fecha_entrada.after_or_equal"=>"La fecha de entrada debe ser mayor o igual al día de hoy",
            "fecha_entrada.before_or_equal"=>"La fecha de entrada debe ser antes de la fecha de salida",
            "fecha_salida.required"=>"La fecha de salida es requerida",
            "fecha_salida.date"=>"Se debe especificar un formato de fecha",
            "fecha_salida.after_or_equal"=>"La fecha de salida debe ser despues de la fecha de entrada",
            "fecha_salida.after"=>"La fecha de salida debe ser después de hoy",
        ]);

        //CÓMO CONTROLAR EL CAMBIO DEL ESTADO EL BUS?
        //Con eso también controlo que no mande un bus dos veces al mismo tiempo a mantenimiento.

        //Después de validar
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $mantenimiento2 = Mantenimiento::where('bus_id', $datos["placa"])
                                        ->where('fecha_entrada', $datos["fecha_entrada"])
                                        ->where('fecha_salida', $datos["fecha_salida"])
                                        ->first();
        
        if ($mantenimiento2) {
            return redirect()->back()->with('alert', "Ya existe un mantenimiento programado para estas fechas");
        }

        $mantenimiento = Mantenimiento::create(["bus_id"=>$datos["placa"],"empresa_id"=>$empresa['id'],"fecha_entrada"=>$datos["fecha_entrada"],
            "fecha_salida"=>$datos["fecha_salida"]]);
        if ($mantenimiento->wasRecentlyCreated == true) {
            return redirect()->back()->with('alert', 'Mantenimiento agregado exitosamente');
        }
        return redirect("/empresa/programar-mantenimiento");




    }
}
