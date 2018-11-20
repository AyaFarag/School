<?php

namespace App\Http\Controllers\Api\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Quiz;
use App\Models\QuizResponse;

use App\Http\Resources\QuizResponseResource;

use App\Http\Requests\Api\Teacher\QuizResponseAwardRequest;

class QuizResponseController extends Controller
{
    public function index(Quiz $quiz) {
        $this -> authorize("view", $quiz);

        $responses = $quiz -> responses() -> latest() -> with("grade") -> paginate();

    	return QuizResponseResource::collection($responses);
    }

    public function award(QuizResponseAwardRequest $request, Quiz $quiz, $quiz_response) {
        $this -> authorize("view", $quiz);

        $quiz_response = $quiz -> responses() -> whereId($quiz_response) -> firstOrFail();

        $quiz_response -> points = $request -> input("points");
        $quiz_response -> save();

        return response() -> json(["message" => trans("api.awarded_successfully")], 200);
    }

    public function destroy(Quiz $quiz, $quiz_response) {
    	$this -> authorize("view", $quiz);

    	if ($quiz -> responses() -> whereId($quiz_response) -> delete() === 0)
    		return abort(404);

    	return response() -> json(["message" => trans("api.deleted_successfully")]);
    }
}
