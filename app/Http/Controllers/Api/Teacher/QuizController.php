<?php

namespace App\Http\Controllers\Api\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Quiz;

use App\Http\Resources\QuizResource;

use App\Http\Requests\Api\Teacher\QuizRequest;

class QuizController extends Controller
{
    public function index(Request $request) {
    	$teacher = auth("teacher-api") -> user();

    	$quizzes = $teacher -> quizzes();

    	if ($request -> filled("session_id"))
    		$quizzes -> where("session_id", $request -> input("session_id"));

    	return QuizResource::collection($quizzes -> paginate());
    }

    public function store(QuizRequest $request) {
        $quiz = Quiz::create($request -> all());

        $quiz -> addMedia($request -> file("attachment"))
            -> toMediaCollection("attachments");

        return new QuizResource($quiz);
    }

    public function update(QuizRequest $request, Quiz $quiz) {
        $this -> authorize("update", $quiz);

        $quiz -> update($request -> all());

        if ($request -> file("attachment")) {
            $quiz -> clearMediaCollection("attachments");
            $quiz -> addMedia($request -> file("attachment"))
                -> toMediaCollection("attachments");
        }

        return new QuizResource($quiz);
    }

    public function show(Quiz $quiz) {
        return new QuizResource($quiz);
    }

    public function destroy(Quiz $quiz) {
        $this -> authorize("delete", $quiz);

        $quiz -> delete();

        return response()
            -> json(["message" => trans("api.deleted_successfully")], 200);
    }
}
