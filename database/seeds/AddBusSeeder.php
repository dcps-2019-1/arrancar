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
        //Factory ya no sirve debio a que randomiza las entradas de las placas y esto ya está normalizado en laa BD
        //factory(Bus::class,5)->create(["empresa_id"=>1]);
        Bus::create(["codigo"=>"610","placa"=>"LKN345","empresa_id"=>1,"numero_sillas"=>25,"categoria"=>"premium"]);
        Bus::create(["codigo"=>"611","placa"=>"KJN215","empresa_id"=>1,"numero_sillas"=>50,"categoria"=>"basico"]);
        Bus::create(["codigo"=>"612","placa"=>"HXQ595","empresa_id"=>1,"numero_sillas"=>34,"categoria"=>"basico"]);
        Bus::create(["codigo"=>"613","placa"=>"MJP202","empresa_id"=>1,"numero_sillas"=>22,"categoria"=>"basico"]);


    }
}
