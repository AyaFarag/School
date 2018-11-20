<?php

use Faker\Generator as Faker;

use App\Models\Session;
use App\Models\Teacher;
use App\Models\SemesterSession;

$factory -> define(Session::class, function (Faker $faker) {
    return [
		"teacher_id"          => Teacher::inRandomOrder() -> first() -> id,
		"semester_session_id" => SemesterSession::inRandomOrder() -> first() -> id
    ];
});
