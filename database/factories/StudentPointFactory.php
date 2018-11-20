<?php

use Faker\Generator as Faker;

use App\Models\StudentPoint;
use App\Models\Student;
use App\Models\Session;

$factory -> define(StudentPoint::class, function (Faker $faker) {
    return [
		"student_id" => Student::inRandomOrder() -> first(),
		"session_id" => Session::inRandomOrder() -> first(),
		"points"     => mt_rand(5, 20),
		"reason"     => $faker -> name
    ];
});
