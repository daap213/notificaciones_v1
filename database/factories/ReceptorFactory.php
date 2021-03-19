<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Receptor;
use Faker\Generator as Faker;

$factory->define(Receptor::class, function (Faker $faker) {
    return [
        'recpetor' =>$faker->numberBetween($min = 1, $max = 7),
		'mensaje_id' =>$faker->numberBetween($min = 1, $max = 7),
    ];
});
