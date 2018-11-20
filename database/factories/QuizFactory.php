<?php

use Faker\Generator as Faker;

use App\Models\Quiz;
use App\Models\SemesterSession;

$factory -> define(Quiz::class, function (Faker $faker) {
    return [
		"title"      => $faker -> word,
		"content"    => $faker -> text(50),
		"session_id" => SemesterSession::inRandomOrder() -> first() -> id,
		"grade"      => mt_rand(5, 20)
    ];
});
