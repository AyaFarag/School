<?php

use Faker\Generator as Faker;

use App\Models\SemesterSession;
use App\Models\ClassModel;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Year ;

$factory -> define(SemesterSession::class, function (Faker $faker) {
    return [
		"class_id"   => ClassModel::inRandomOrder() -> first() -> id,
		"teacher_id" => Teacher::inRandomOrder() -> first() -> id,
		"subject_id" => Subject::inRandomOrder() -> first() -> id,
		"year_id"    => Year::inRandomOrder() -> first() -> id
    ];
});
