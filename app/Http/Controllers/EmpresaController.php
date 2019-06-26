<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conductor;
use App\Empresa;
use App\User;
use Auth;

class EmpresaController extends Controller
{
    public function index()
    {
        return view('empresa.inicio');
    }

    public function listarConductores()
    {
        $empresa = Empresa::where('user_id', Auth::user()->id)->first();
        $conductores = Conductor::where('empresa_id', $empresa->id)->get();
        return view('empresa.registrar-conductor')->with('conductores', $conductores);
    }

    public function  registrarConductores(){
        //Validar que los datos esten completos
        $data=request()->validate(["nombre"=>"required",
            "cedula"=>"required|unique:conductores,cedula",
            "email"=>"required|unique:users,email",
            "username"=>"required|unique:users,email",
            "password"=>"required",
            "telefono"=>"required"],["nombre.required"=>"El campo nombre es obligatorio",
                "cedula.required"=>"El campo cédula es obligatorio",
                "cedula.unique"=>"Esta cédula ya está asociada a otro conductor",
                "username.required"=>"El campo username es obligatorio",
                "username.unique"=>"Este username ya existe para algún conductor",
                "password.required"=>"El campo password es obligatorio",
                "telefono.required"=>"El campo teléfono es obligatorio",
            "email.required"=>"El campo email es obligatorio",
            "email.unique"=>"El email ya existe en el sistema"]);
        //Obtengamos primero el id de la empresa en la tabla empresas. Sabiendo que estoy con el id de la empresa en la tabla usuarios
        $idDeEmpresaEnusuarios= Auth::user()->id;
        $idDeEmpresaEnEmpresas=Empresa::where("user_id",$idDeEmpresaEnusuarios)->first();
        $idEmpresaParaConductor=$idDeEmpresaEnEmpresas->id;

        //Agregar nuevo usuario a la tabla general
        $newUser=User::create(["username"=>$data["username"],
            "email"=>$data["email"],
            "password"=>$data["password"],
            "rol"=>3,
            "telefono"=>$data["telefono"]]);
        $newConductor=Conductor::create(["user_id"=>$newUser->id,
            "nombre"=>$data["nombre"],
            "cedula"=>$data["cedula"],
            "empresa_id"=>$idEmpresaParaConductor]);
        $exito="El conductor ha sido agregado con exito";
        return view('empresa.inicio');
}

}
