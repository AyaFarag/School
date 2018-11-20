<?php

use Faker\Generator as Faker;

use App\Models\ClassModel;
use App\Models\Level;

$factory -> define(ClassModel::class, function (Faker $faker) {
    return [
			"name"     => $faker -> name,
			"level_id" => Level::inRandomOrder() -> first() -> id  
    ];
});
