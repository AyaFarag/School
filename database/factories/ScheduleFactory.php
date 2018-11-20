<?php

use Faker\Generator as Faker;

use App\Models\SemesterSession;
use App\Models\Schedule;

$days = [
	"saturday",
	"sunday",
	"monday",
	"tuesday",
	"wednesday",
	"thursday",
	"friday"
];

$factory -> define(Schedule::class, function (Faker $faker) {
    return [
		"semester_session_id" => SemesterSession::inRandomOrder() -> first() -> id,
		"day"                 => $faker -> randomElement([
			"saturday",
			"sunday",
			"monday",
			"tuesday",
			"wednesday",
			"thursday",
			"friday"
		]),
		"from"                => $faker -> time,
		"to"                  => $faker -> time,
    ];
});
