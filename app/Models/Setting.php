<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        "social_networks",
        "phone_numbers",
        "emails",
        "addresses",
        "websites"
    ];

    protected $casts = [
        "social_networks" => "array",
        "phone_numbers"   => "array",
        "emails"          => "array",
        "addresses"       => "array",
        "websites"        => "array"
    ];
}
