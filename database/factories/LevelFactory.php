<?php

use Faker\Generator as Faker;
use App\Models\Level as Level;

$factory->define(Level::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
    ];
});
