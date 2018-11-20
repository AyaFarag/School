<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Year;
use App\Models\StudentPoint;

class PointController extends Controller
{
    public function index(Student $student, Year $year) {
    	$points = StudentPoint::where("student_id", $student -> id)
	    	-> whereHas("session.semesterSession", function ($query) use ($year) {
	    		$query -> where("year_id", $year -> id);
	    	}) -> paginate();

    	return view("admin.student.year.point.index", compact("student", "year", "points"));
    }
}
