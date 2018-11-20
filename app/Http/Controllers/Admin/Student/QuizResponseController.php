<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Year;
use App\Models\QuizResponse;

class QuizResponseController extends Controller
{
    public function index(Student $student, Year $year) {
    	$responses = QuizResponse::with("quiz")
    		-> where("student_id", $student -> id)
    		-> whereHas("quiz.session.semesterSession", function ($query) use ($year) {
    			return $query -> where("year_id", $year -> id);
    		}) -> paginate();
    		
    	return view("admin.student.year.quiz-response.index", compact("student", "year", "responses"));
    }
}
