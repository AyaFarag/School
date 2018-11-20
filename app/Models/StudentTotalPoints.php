<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTotalPoints extends Model
{
	protected $table = "students_total_points";

    public function student() {
    	return $this -> belongsTo(Student::class);
    }

    public function semesterSession() {
    	return $this -> belongsTo(SemesterSession::class);
}
