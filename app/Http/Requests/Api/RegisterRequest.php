<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name"          => "required",
            "email"         => "required|email|unique:users",
            "password"      => "required|min:6|confirmed",
            "device_token"  => "nullable",
            "phone_numbers" => "required|array"
        ];
    }
}
