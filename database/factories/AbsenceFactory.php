<?php

use Faker\Generator as Faker;

use App\Models\Absence;
use App\Models\Student;
use App\Models\Session;

$factory -> define(Absence::class, function (Faker $faker) {
    return [
		"session_id" => Session::inRandomOrder() -> first() -> id,
		"student_id" => Student::inRandomOrder() -> first() -> id,
		"date"       => $faker -> date,
    ];
});
