<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Hash;

class Teacher extends Authenticatable
{
    protected $fillable = [
    	"branch_id",
    	"name",
    	"email",
    	"password",
    	"phone",
    	"description",
    	"address",
    	"gender",
    	"birth_date",
    	"nationality",
    	"device_token"
    ];

    static function selectOptions() {
        return self::with("branch")
            -> orderBy("branch_id")
            -> get()
            -> reduce(function ($cr, $teacher) {
                $cr[$teacher -> id] = "{$teacher -> branch -> name} - {$teacher -> name}";
                return $cr;
            }, []);
    }

    public function branch() {
        return $this -> belongsTo(Branch::class);
    }

    public function sessions() {
    	return $this -> hasMany(Session::class);
    }

    public function semesterSessions() {
    	return $this -> hasMany(SemesterSession::class);
    }

    public function quizzes() {
        return $this -> hasManyThrough(Quiz::class, Session::class);
    }

    public function setPasswordAttribute($value) {
        $this -> attributes["password"] = Hash::needsReHash($value)
            ? Hash::make($value)
            : $value;
    }

    public function scopeSearch($query, $search) {
        return $query -> where(function ($query) use ($search) {
            $query -> where("name", "like", "%{$search}%")
                -> orWhere("email", "like", "%{$search}%");
        });
    }
}
