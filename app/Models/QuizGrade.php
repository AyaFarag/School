<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizGrade extends Model
{
    protected $fillable = ["quiz_response_id", "student_id", "points"];

    public function quizResponse() {
    	return $this -> belongsTo(QuizResponse::class);
    }

    public function student() {
    	return $this -> belongsTo(Student::class);
    }
}
