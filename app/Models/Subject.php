<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ["name"];

    public function semesterSession() {
    	return $this -> hasMany(SemesterSession::class);
    }

    public function scopeSearch($query, $search) {
        return $query -> where("name", "like", "%{$search}%");
    }
}
