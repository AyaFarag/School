<?php

use Faker\Generator as Faker;

use App\Models\Student;
use App\Models\Quiz;
use App\Models\QuizResponse;

$factory->define(QuizResponse::class, function (Faker $faker) {
    return [
		"student_id" => Student::inRandomOrder() -> first() -> id,
		"quiz_id"    => Quiz::inRandomOrder() -> first() -> id,
		"content"    => $faker -> text(100),
		"points"     => mt_rand(0, 1) === 0 ? mt_rand(2, 10) : null
    ];
});
