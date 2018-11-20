<?php

use Faker\Generator as Faker;

use App\Models\StudentOfDay;
use App\Models\Student;
use App\Models\Session;

$factory -> define(StudentOfDay::class, function (Faker $faker) {
    return [
        "student_id" => Student::inRandomOrder() -> first() -> id,
        "session_id" => Session::inRandomOrder() -> first() -> id
    ];
});
