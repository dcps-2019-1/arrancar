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

        factory(Bus::class,5)->create(["empresa_id"=>1]);


    }
}
