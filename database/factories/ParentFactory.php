<?php

use Faker\Generator as Faker;

use App\Models\ParentModel;

$factory -> define(ParentModel::class, function (Faker $faker) {
    return [
        "name" => $faker -> name,
        "email" => $faker -> email,
        "password" => bcrypt("qwe123"),
        "phone" => $faker -> e164PhoneNumber
    ];
});
