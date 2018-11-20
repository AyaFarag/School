<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ["semester_session_id"];

    public function semesterSession() {
    	return $this -> belongsTo(SemesterSession::class);
    }

    public function teacher() {
    	return $this -> belongsTo(Teacher::class);
    }

    public function studentsOfDay() {
    	return $this -> belongsToMany(Student::class, "students_of_day")
            -> withTimestamps();
    }

    public function quizzes() {
    	return $this -> hasMany(Quiz::class);
    }

    public function points() {
    	return $this -> hasMany(Point::class);
    }

    public function absences() {
    	return $this -> belongsToMany(Student::class, "absences")
            -> withPivot("has_permission")
            -> withTimestamps();
    }
}
