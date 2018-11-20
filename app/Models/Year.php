<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Year extends Model
{
    protected $fillable = ["from", "to"];

    protected $dates = ["from", "to"];

    static function selectOptions() {
    	return self::latest()
    		-> get()
    		-> pluck("title", "id");
    }

    public function semesterSessions() {
    	return $this -> hasMany(SemesterSession::class);
    }

    public function students() {
    	return $this -> belongsToMany(Student::class, "class_student_year")
    		-> withPivot("joined_bus", "seat_number");
    }

    public function getFromAttribute($value) {
        return Carbon::parse($value) -> format(config("defaults.date_format"));
    }

    public function getToAttribute($value) {
        return Carbon::parse($value) -> format(config("defaults.date_format"));
    }

    public function getTitleAttribute() {
        return $this -> from . "/" . $this -> to;
    }

    public function scopeJoinSessions($query) {
        $query -> leftJoin("semester_sessions", "semester_sessions.year_id", "=", "years.id")
            -> leftJoin("sessions", "sessions.semester_session_id", "=", "semester_sessions.id")
            -> where("years.id", $this -> id);
    }

    public function scopeJoinQuizzes($query) {
        return $query -> joinSessions()
            -> leftJoin("quizzes", "quizzes.session_id", "=", "sessions.id");
    }

    public function scopeJoinQuizResponses($query) {
        $query -> joinQuizzes()
            -> leftJoin("quiz_responses", "quiz_responses.quiz_id", "=", "quizzes.id");
    }

    public function scopeJoinStudentsOfDay($query) {
        $query -> joinSessions()
            -> leftJoin("students_of_day", "sessions.id", "=", "students_of_day.session_id");
    }

    public function scopeJoinAbsences($query) {
        $query -> joinSessions()
            -> leftJoin("absences", "sessions.id", "=", "absences.session_id");
    }

    public function scopeJoinStudentPoints($query) {
        $query -> joinSessions()
            -> leftJoin("student_points", "sessions.id", "=", "student_points.session_id");
    }
}
