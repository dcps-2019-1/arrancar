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
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    //Seeder para meter conductores a la BD, así mismo, primero se debe crear el usuario en la tabla general.
        $newuser=factory(User::class)->create();
        Conductor::create(["user_id"=>$newuser->id,"nombre"=>"Juancho",
            "cedula"=>98631127]);


    }
}
