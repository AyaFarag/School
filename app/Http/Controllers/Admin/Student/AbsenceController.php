<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Year;
use App\Models\Student;
use App\Models\Absence;

class AbsenceController extends Controller
{
    public function index(Student $student, Year $year) {
    	$absences = Absence::with("session")
    		-> where("student_id", $student -> id)
	    	-> whereHas("session.semesterSession", function ($query) use ($year) {
	    		return $query -> where("year_id", $year -> id);
	    	}) -> paginate();
    	return view("admin.student.year.absence.index", compact("absences", "student", "year"));
    }
}
