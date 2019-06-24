<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use Faker\Generator as Faker;
//este factory es solo para añadir conductores, para hacer el manejo de el hecho de que toca añadir en dos tablas diferentes
$factory->define(User::class, function (Faker $faker) {

    return [ "username"=>$faker->unique()->userName,
        "email"=>$faker->unique()->email,
        "password"=>bcrypt($faker->password),
        "telefono"=>$faker->phoneNumber,

    ];
});
