<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use App\User;
use App\Conductor;
use Faker\Generator as Faker;

class AddConductoresSeeder extends Seeder
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    //Seeder para meter conductores a la BD, así mismo, primero se debe crear el usuario en la tabla general.
        for ($i = 1; $i <= 10; $i++) {
            $newuser = factory(User::class)->create(["rol" => 3]); // le envio rol 3, porque quiero crear conductores. Guardo
            //el objeto User en un array porque necesito algunos datos de acá, para enviarlos a el factory de conductor.
            //Acá llamo al factory de conductor, y le mando el parametro id del usuario que acabe de crear, su factory hace el resto
            factory(Conductor::class)->create((["user_id" => $newuser->id]));
            }

    }
}
