<?php

use Faker\Generator as Faker;
use App\Models\Branch;

$factory -> define(Branch::class, function (Faker $faker) {
    return [
		"name"    => $faker -> company,
		"lat"     => $faker -> randomFloat(5, -90, 90),
		"lng"     => $faker -> randomFloat(5, -180, 180),
		"address" => $faker -> streetAddress
    ];
});
