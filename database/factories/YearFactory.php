<?php

use Faker\Generator as Faker;

use App\Models\Year;

$factory -> define(Year::class, function (Faker $faker) {
    return [
        "from" => $faker -> date,
        "to" => $faker -> date
    ];
});
