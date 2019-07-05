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
        return view('empresa.inicio',["user"=>Auth::user()]);
    }

    public function vistaRegistrar()
    {
        return view('empresa.registrar-conductor',["user"=>Auth::user()]);
    }

    public function  registrarConductores(){
        //Validar que los datos esten completos
        $data=request()->validate(["nombre"=>"required",
            "cedula"=>"required|unique:conductores,cedula|numeric",
            "email"=>"required|unique:users,email|email",
            "username"=>"required|unique:users,username",
            "password"=>"required|min:6",
            "telefono"=>"required|numeric"],["nombre.required"=>"El campo nombre es obligatorio",
                "cedula.numeric"=>"El campo cédula debe ser númerico",
                "cedula.required"=>"El campo cédula es obligatorio",
                "cedula.unique"=>"Esta cédula ya está asociada a otro conductor",
                "username.required"=>"El campo username es obligatorio",
                "username.unique"=>"Este username ya existe para algún conductor",
                "password.required"=>"El campo password es obligatorio",
                "password.min"=>"La contraseña debe tener mínimo 6 caracteres",
                "telefono.required"=>"El campo teléfono es obligatorio",
            "telefono.numeric"=>"El numero de teléfono debe ser numerico",
            "email.required"=>"El campo email es obligatorio",
            "email.unique"=>"El email ya existe en el sistema",
            "email.email"=>"El email no tiene formato válido"]);
        //Obtengamos primero el id de la empresa en la tabla empresas. Sabiendo que estoy con el id de la empresa en la tabla usuarios
        $idDeEmpresaEnusuarios= Auth::user()->id;
        $idDeEmpresaEnEmpresas=Empresa::where("user_id",$idDeEmpresaEnusuarios)->first();
        $idEmpresaParaConductor=$idDeEmpresaEnEmpresas->id;

        //Agregar nuevo usuario a la tabla general
        $newUser=User::create(["username"=>$data["username"],
            "email"=>$data["email"],
            "password"=>bcrypt($data["password"]),
            "rol"=>3,
            "telefono"=>$data["telefono"]]);
        if($newUser->wasRecentlyCreated == true){
            $newConductor = Conductor::create([
                "user_id" => $newUser->id,
                "nombre" => $data["nombre"],
                "cedula" => $data["cedula"],
                "empresa_id" => $idEmpresaParaConductor
            ]);
            if ($newConductor->wasRecentlyCreated == true) {
                return redirect()->back()->with('alert', 'Conductor agregado exitosamente');
            } 
        }
        return redirect("/empresa/registrar-conductor");
}

}
