<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Hash;

class ParentModel extends Authenticatable
{
    protected $table = "parents";

    protected $fillable = ["name", "email", "password", "phone", "device_token"];

    protected $hidden = ["password"];

    static function selectOptions() {
        return self::orderBy("name") -> pluck("name", "id") -> all();
    }

    public function children() {
    	return $this -> hasMany(Student::class, "parent_id");
    }

    public function setPasswordAttribute($value) {
        $this -> attributes["password"] = Hash::needsReHash($value)
            ? Hash::make($value)
            : $value;
    }
}
