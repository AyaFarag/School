<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;
use App\Models\Year;
use App\Models\Quiz;
use App\Models\Absence;
use App\Models\StudentOfDay;
use App\Models\StudentPoint;
use App\Models\QuizGrade;

use App\Services\StudentService;
use App\Services\ClassService;

class DataController extends Controller
{
    public function show(Student $student, Year $year) {
        $studentService = new StudentService($student, $year);
        $classService   = new ClassService($student -> classes() -> first(), $year);

        $total_student_of_day = $studentService -> studentOfDayCount();
        $total_quiz_points    = $classService -> totalQuizPoints();
        $total_absences       = $studentService -> absenceCount();
    	$points = [
			"student_of_day" => $total_student_of_day * config("defaults.student_of_day_multiplier"),
			"quiz"           => $studentService -> totalQuizPoints(),
			"other"          => $studentService -> totalOtherPoints()
    	];
    	$data = compact(
    		"student",
    		"points",
    		"total_student_of_day",
    		"total_quiz_points",
    		"total_absences",
    		"year"
    	);

    	return view("admin.student.year.show", $data);
    }
}
