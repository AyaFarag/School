<?php

namespace App\Services;

use App\Models\Year;
use App\Models\ClassModel;

class ClassService {
	private $class;
	private $year;

	public function __construct(ClassModel $class, Year $year) {
		$this -> class = $class;
		$this -> year  = $year;
	}

	public function totalQuizPoints() : float {
		return $this -> year
			-> joinQuizzes()
			-> selectRaw("SUM(grade) as total")
			-> where("semester_sessions.class_id", $this -> class -> id)
			-> first()
			-> total
			?? 0;
	}
}