<?php

use Faker\Generator as Faker;

use App\Models\Teacher;
use App\Models\Branch;

$factory -> define(Teacher::class, function (Faker $faker) {
    return [
		"branch_id"   => Branch::inRandomOrder() -> first() -> id,
		"name"        => $faker -> name,
		"email"       => $faker -> email,
		"description" => $faker -> text(50),
		"address"     => $faker -> streetAddress,
		"phone"       => $faker -> e164PhoneNumber,
		"gender"      => $faker -> randomElement(["male", "female", "other"]),
		"password"    => bcrypt("qwe123"),
		"birth_date"  => $faker -> date,
		"nationality" => $faker -> country
    ];
});
