<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Empresa;
use Faker\Generator as Faker;

$factory->define(Empresa::class, function (Faker $faker) {
    return ["nit"=>$faker->unique()->numberBetween(1000000,9000000),
        "representante-legal"=>$faker->name,
        "nombre"=>$faker->unique()->name
        //
    ];
});
