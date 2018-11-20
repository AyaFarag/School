<?php

namespace App\Services;

use App\Models\Student;
use App\Models\Year;

class StudentService {
	private $student;
	private $year;

	public function __construct(Student $student, Year $year) {
		$this -> student = $student;
		$this -> year    = $year;
	}

	public function studentOfDayCount() : int {
		return $this -> year
			-> joinStudentsOfDay()
            -> where("students_of_day.student_id", $this -> student -> id)
            -> count();
    }

	public function totalQuizPoints() : float {
		return $this -> year
			-> joinQuizResponses()
            -> where("quiz_responses.student_id", $this -> student -> id)
            -> selectRaw("SUM(quiz_responses.points) as total")
            -> first()
            -> total
            ?? 0;
    }

    public function totalOtherPoints() : float {
    	return $this -> year
    		-> joinStudentPoints()
    		-> where("student_points.student_id", $this -> student -> id)
    		-> selectRaw("SUM(points) as total")
    		-> first()
    		-> total
    		?? 0;
    }

    public function absenceCount() : int {
    	return $this -> year
    		-> joinAbsences()
    		-> where("absences.student_id", $this -> student -> id)
    		-> count();
    }
}