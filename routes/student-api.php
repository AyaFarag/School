<?php



Route::group(["middleware" => "auth:student-api"], function () {
	Route::get("schedule", "ScheduleController@index");
});