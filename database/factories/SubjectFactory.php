<?php

use Faker\Generator as Faker;

use App\Models\Subject;

$factory -> define(Subject::class, function (Faker $faker) {
    return [
        "name" => $faker -> name
    ];
});
