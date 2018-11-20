<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Hash;

class Admin extends Authenticatable
{
    protected $fillable = [
        "name", "email", "permissions", "password"
    ];

    protected $hidden = [
        "password"
    ];

    protected $casts = [
        "permissions" => "array"
    ];

    public function setPasswordAttribute($value) {
        $this -> attributes["password"] = Hash::needsReHash($value)
            ? Hash::make($value)
            : $value;
    }

    public function isSuperAdmin() {
        return in_array("admin", $this -> permissions);
    }

    public function scopeSearch($query, $search) {
        return $query -> where(function ($query) use ($search) {
            $query -> where("name", "like", "%{$search}%")
                -> orWhere("email", "like", "%{$search}%");
        });
    }
}
