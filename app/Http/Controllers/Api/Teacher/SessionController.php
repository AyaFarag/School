<?php

namespace App\Http\Controllers\Api\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Session;

use App\Http\Requests\Api\Teacher\Session\SessionStartRequest;
use App\Http\Requests\Api\Teacher\Session\SessionRequest;

class SessionController extends Controller
{
    public function store(SessionStartRequest $request) {
    	$teacher = auth("teacher-api") -> user();
        // validate if the teacher is assigned the selected semester session
    	$session = new Session($request -> all());
        $session -> teacher_id = $teacher -> id;
        $session -> save();

    	return response() -> json([
    		"message" => trans("api.session_started"),
    		"data"    => ["id" => $session -> id]
		], 200);
    }

    public function update(SessionRequest $request, Session $session) {
    	$this -> authorize("update", $session);
    	$session -> absences() -> sync(
            array_reduce($request -> input("absent_students"), function ($acc, $item) {
                $acc[$item["id"]] = ["has_permission" => $item["has_permission"]];
                return $acc;
            }, [])
        );
    	$session -> studentsOfDay() -> sync($request -> input("student_of_day_id"));

    	return response() -> json([
    		"message" => trans("api.updated_successfully")
    	], 200);
    }
}
