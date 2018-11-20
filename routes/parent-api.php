<?php


Route::get("children", "StudentController@index");

Route::group([
	"middleware" => ["auth:parent-api"],
	"prefix"     => "{child}"
], function () {
	Route::get("schedule", "ScheduleController@index");
});