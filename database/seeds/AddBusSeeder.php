<?php

use Illuminate\Database\Seeder;
use App\Bus;
use \Illuminate\Support\Facades\DB;
class AddBusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //control de errores.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table("buses")->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        //factory(Bus::class,5)->create(["empresa_id"=>1]);
        Bus::create(["codigo"=>"610","placa"=>"JKD123","empresa_id"=>1,"numero_sillas"=>60,"categoria"=>"premium"]);
        Bus::create(["codigo"=>"620","placa"=>"MJP202","empresa_id"=>1,"numero_sillas"=>60,"categoria"=>"basico"]);
        Bus::create(["codigo"=>"730","placa"=>"HXQ959","empresa_id"=>1,"numero_sillas"=>45,"categoria"=>"premium"]);
        Bus::create(["codigo"=>"450","placa"=>"SLP246","empresa_id"=>2,"numero_sillas"=>60,"categoria"=>"basico"]);



    }
}
