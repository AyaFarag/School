<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ["semester_session_id", "day", "from", "to"];

    public function semesterSession() {
    	return $this -> belongsTo(SemesterSession::class);
    }

    public function getFromAttribute($value) {
    	return date("H:i", strtotime($value));
    }

    public function getToAttribute($value) {
    	return date("H:i", strtotime($value));
    }
}
