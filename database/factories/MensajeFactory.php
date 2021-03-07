<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Mensaje;
use Faker\Generator as Faker;

$factory->define(Mensaje::class, function (Faker $faker) {
    return [
        'tema' => $faker->sentence,
        'mensaje' => $faker->text,
        'receptor' => $faker->name,
        'user_id' =>$faker->numberBetween($min = 1, $max = 7),
    ];
});
