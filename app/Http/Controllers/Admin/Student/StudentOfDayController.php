<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Year;
use App\Models\StudentOfDay;

class StudentOfDayController extends Controller
{
    public function index(Student $student, Year $year) {
    	$student_of_days = StudentOfDay::where("student_id", $student -> id)
    		-> whereHas("session.semesterSession", function ($query) use ($year) {
    			$query -> where("year_id", $year -> id);
    		}) -> paginate();

    	return view("admin.student.year.student-of-day.index", compact("student", "year", "student_of_days"));
    }
}
