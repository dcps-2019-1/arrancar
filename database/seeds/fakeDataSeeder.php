<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\User;
use App\Conductor;
use App\Empresa;
use App\Cliente;
use App\Administrador;
use Faker\Generator as Faker;

class fakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //control de errores.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table("users")->truncate();
        DB::table("conductores")->truncate();
        DB::table("empresas")->truncate();
        DB::table('administradores')->truncate();
        DB::table('clientes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        //usuarios de prueba conductor y empresa:

        //empresa1
        $userfakeempresa=User::create(["username"=>"empresa1","email"=>"empresa1@unal.edu.co","password"=>bcrypt("123456"),"telefono"=>2312345,"rol"=>2]);
        $empresa=Empresa::create(["user_id"=>$userfakeempresa->id,"nombre"=>"Transportes chimberos","nit"=>122233323,"representante-legal"=>"Alvaro Uribe Velez"]);
        //empresa2
        $userfakeempresa=User::create(["username"=>"empresa2","email"=>"empre1@unal.edu.co","password"=>bcrypt("123456"),"telefono"=>2312345,"rol"=>2]);
        $empresa=Empresa::create(["user_id"=>$userfakeempresa->id,"nombre"=>"Transportes cuca","nit"=>285323,"representante-legal"=>"El papa vergoglio"]);


        $userfakecliente = User::create(["username" => "cliente1", "email" => "cliente1@unal.edu.co", "password" => bcrypt("123456"), "telefono" => 12323443, "rol" => 0]);
        $cliente=Cliente::create(["user_id"=>$userfakecliente->id, "nombre"=>"Loquendo", "medio_pago"=>"No se que poner", "contacto_emergencia"=>123345, "cedula"=>6765432222]);

        $userfakeadministrador = User::create(["username" => "administrador1", "email" => "administrador1@unal.edu.co", "password" => bcrypt("123456"), "telefono" => 12323453, "rol" => 1]);
        Administrador::create(["user_id"=>$userfakeadministrador->id]);

        $userfakeconductor=User::create(["username"=>"conductor1","email"=>"conductor1@unal.edu.co","password"=>bcrypt("123456"),"telefono"=>2322345,"rol"=>3]);
        $conductor=Conductor::create(["empresa_id"=>$empresa->id,"user_id"=>$userfakeconductor->id,"nombre"=>"Ivan Duque","cedula"=>234567]);
        //Seeder para meter conductores y empresas a la BD, así mismo, primero se debe crear el usuario en la tabla general.
        for ($i = 1; $i <= 10; $i++) {

            $newuserconductor = factory(User::class)->create(["rol" => 3]); // le envio rol 3, porque quiero crear conductores. Guardo
            //el objeto User en un array porque necesito algunos datos de acá, para enviarlos a el factory de conductor.

            $newuserempresa=factory(User::class)->create(["rol" => 2]);// 2 de empresa
            //Acá llamo al factory de conductor, y le mando el parametro id del usuario que acabe de crear, su factory hace el resto
            factory(Conductor::class)->create((["user_id" => $newuserconductor->id]));
            factory(Empresa::class)->create((["user_id" => $newuserempresa->id]));

        }

    }
}
