<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Conductor;
use Faker\Generator as Faker;

$factory->define(Conductor::class, function (Faker $faker) {
    return [
        "nombre"=>$faker->name,
        "cedula"=>$faker->unique()->numberBetween(123456,999999999)
        //
    ];
});
