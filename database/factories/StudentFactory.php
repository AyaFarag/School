<?php

use Faker\Generator as Faker;

use App\Models\Student;
use App\Models\ParentModel;
use App\Models\Branch;
use App\Models\ClassModel;

$factory -> define(Student::class, function (Faker $faker) {
    return [
		"parent_id"   => ParentModel::inRandomOrder() -> first() -> id,
		"branch_id"   => Branch::inRandomOrder() -> first() -> id,
		"ssn"         => $faker -> creditCardNumber,
		"name"        => $faker -> name,
		"phone"       => $faker -> e164PhoneNumber,
		"gender"      => $faker -> randomElement(["male", "female", "other"]),
		"password"    => bcrypt("qwe123"),
		"birth_date"  => $faker -> date,
		"nationality" => $faker -> country
    ];
});
