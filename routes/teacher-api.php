<?php



Route::group(["middleware" => "auth:teacher-api"], function () {
	//===============================================================
	//
	// SCHEDULE
	//
	//===============================================================

	Route::get("schedule", "ScheduleController@index");



	//===============================================================
	//
	// SESSIONS
	//
	//===============================================================

	Route::post("session", "SessionController@store");
	Route::put("session/{session}", "SessionController@update");



	//===============================================================
	//
	// QUIZZES
	//
	//===============================================================

	Route::resource("quiz", "QuizController") -> only("index", "store", "show", "update", "destroy");



	//===============================================================
	//
	// QUIZ RESPONSES & GRADES
	//
	//===============================================================

	Route::get("quiz/{quiz}/response", "QuizResponseController@index");
	Route::post("quiz/{quiz}/response/{quiz_response}", "QuizResponseController@award");
	Route::delete("quiz/{quiz}/response/{quiz_response}", "QuizResponseController@destroy");
});