<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Emisor;
use Faker\Generator as Faker;

$factory->define(Emisor::class, function (Faker $faker) {
    return [
        'emisor' =>$faker->numberBetween($min = 1, $max = 7),
		'mensaje_id' =>$faker->numberBetween($min = 1, $max = 7),
    ];
});
