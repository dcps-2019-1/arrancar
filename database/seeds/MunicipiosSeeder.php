<?php

use Illuminate\Database\Seeder;
use App\Municipio;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('municipios')->delete();
        $json = File::get("database/data/municipios2.json");
        $data = json_decode($json);
        foreach ($data->data as $obj) {
            Municipio::create(array(
                'departamento' => $obj[10],
                'municipio' => $obj[12],
            ));
        }
    }
}
