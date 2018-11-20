<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemesterSession extends Model
{
    protected $fillable = ["class_id", "teacher_id", "subject_id"];

    public function class() {
    	return $this -> belongsTo(ClassModel::class);
    }

    public function teacher() {
    	return $this -> belongsTo(Teacher::class);
    }

    public function subject() {
    	return $this -> belongsTo(Subject::class);
    }

    public function schedules() {
        return $this -> hasMany(Schedule::class);
    }

    public function scopeFilter($query, $attributes) {
        if (!empty($attributes["teacher_id"]))
            $query -> where("teacher_id", $attributes["teacher_id"]);
        if (!empty($attributes["class_id"]))
            $query -> where("class_id", $attributes["class_id"]);
        if (!empty($attributes["subject_id"]))
            $query -> where("subject_id", $attributes["subject_id"]);
        if (!empty($attributes["year_id"]))
            $query -> where("year_id", $attributes["year_id"]);
    }
}
