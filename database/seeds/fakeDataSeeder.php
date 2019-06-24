<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\User;
use App\Conductor;
use App\Empresa;
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

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