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

public function  registrarEmpresa(){
        return view("administrador.registroEmpresa",["user"=>Auth::user()]);

}

    public function  agregarEmpresa(){
        $data=request()->validate(["nombre"=>"required","username"=>"required|unique:users,username",
            "password"=>"required|min:6","email"=>"required|unique:users,email|email",
            "representante"=>"required","telefono"=>"required|numeric", "nit"=>"required|unique:empresas,nit|numeric"],[
                "nombre.required"=>"El nombre de la empresa es obligatorio","username.required"=>"El nombre de usuario es obligatorio",
            "username.unique"=>"Este nombre de usuario ya está en uso","password.required"=>"La contraseña es obligatoria",
            "password.min"=>"La contraseña debe tener mínimo 6 caracteres","email.required"=>"El email es obligatorio","email.unique"=>"El email
            ya pertenece a otro usuario","email.email"=>"El formato del email no es valido","representante.required"=>"El representante es obligatorio",
            "telefono.required"=>"El número de teléfono es obligatorio","telefono.numeric"=>"El teléfono debe de ser númerico","nit.required"=>"El nit es obligatorio",
            "nit.unique"=>"El nit ya está asociado a otra empresa","nit.numeric"=>"El nit debe ser numerico"]);

        //Primero se añade la empresa a la tabla de usuarios:
        $nuevoUsuario=User::create(["username"=>$data["username"],
            "password"=>bcrypt($data["password"]),
            "telefono"=>$data["telefono"],
            "email"=>$data["email"],
            "rol"=>2]); //darle el rol de empresa

        if ($nuevoUsuario->wasRecentlyCreated == true) {
            $empresaid=$nuevoUsuario->id;
            $nuevaempresa=Empresa::create(["user_id"=>$empresaid,
                "nombre"=>$data["nombre"],
                "representante-legal"=>$data["representante"],
                "nit"=>$data["nit"]]);
            if ($nuevaempresa->wasRecentlyCreated == true) {
                return redirect()->back()->with('alert', 'Empresa agregada exitosamente');

            }
        }
        return redirect("/admin/registrar-empresa");





    }

    public function borrarEmpresa(){
        $empresas=Empresa::all();
        return(view("administrador.borrarEmpresa",["empresas"=>$empresas]));


    }

    public function borrar(){

        $data=request()->validate(["empresa"=>"required|exists:empresas,id"],["empresa.required"=>"El nombre de la empresa es requerido",
            "empresa.exists"=>"La empresa indicada no existe en el sistema"]);
        //Obtengo la empresa
        $borrar=Empresa::where("id",$data["empresa"])->first();
        $borraraux=Empresa::where("id",$data["empresa"])->first();
        //Ejecuto metodo que borra relaciones
        $borrar->borrado();
        //borro la empresa
        $borrar->delete($this);
        //borro el usuario
        $borraraux->user->delete();
        $empresas=Empresa::all();

        return redirect()->back()->with('alert', 'Empresa borrada exitosamente');


    }
}
