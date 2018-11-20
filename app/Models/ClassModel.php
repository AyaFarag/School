<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
	protected $table = "classes";

    protected $fillable = ["level_id", "name"];

    static function selectOptions() {
        return self::with("level")
            -> orderBy("level_id")
            -> get()
            -> reduce(function ($cr, $class) {
                $cr[$class -> id] = "{$class -> level -> name} - {$class -> name}";
                return $cr;
            }, []);
    }

    public function semesterSessions() {
        return $this -> hasMany(SemesterSession::class, "class_id");
    }

    public function schedule() {
        return $this -> hasManyThrough(Schedule::class, SemesterSession::class, "class_id", "semester_session_id");
    }

    public function subjects() {
        return $this -> belongsToMany(Subject::class, "semester_sessions", "class_id", "subject_id");
    }

    public function students() {
        return $this -> hasMany(Student::class);
    }

    public function level() {
        return $this -> belongsTo(Level::class);
    }

}
