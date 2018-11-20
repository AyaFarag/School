<?php

use Faker\Generator as Faker;

$factory -> define(\App\Models\Admin::class, function (Faker $faker) {
    return [
        "name" => $faker -> name,
        "email" => "admin@mail.com",
        "password" => bcrypt("qwe123"),
        "permissions" => ["admin"]
    ];
});
