<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Bus;

use Faker\Generator as Faker;

$factory->define(Bus::class, function (Faker $faker) {
        $principio=(string)$faker->unique->numberBetween(100,999);
        $fin=(string)$faker->unique->words(1,true);
    return [
        //
        "placa"=>$principio.$fin,
        "codigo"=>$faker->numberBetween(100,999),
        "numero_sillas"=>$faker->numberBetween(15,40),

    ];
});
