<?php

use Faker\Generator as Faker;

use App\Models\Announcement;
use App\Models\SemesterSession;

$factory -> define(Announcement::class, function (Faker $faker) {
    return [
		"semester_session_id" => SemesterSession::inRandomOrder() -> first() -> id,
		"title"               => $faker -> word,
		"content"             => $faker -> text
    ];
});
