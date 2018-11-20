<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentOfDay extends Model
{
    protected $table = "students_of_day";

    protected $fillable = ["session_id", "student_id"];

    protected $dates = ["created_at"];

    public function student() {
        return $this -> belongsTo(Student::class);
    }

    public function session() {
        return $this -> belongsTo(Session::class);
    }
}
