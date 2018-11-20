<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPoint extends Model
{
    protected $fillable = ["points", "session_id", "student_id", "reason"];

    public function student() {
    	return $this -> belongsTo(Student::class);
    }

    public function session() {
    	return $this -> belongsTo(Session::class);
    }
}
