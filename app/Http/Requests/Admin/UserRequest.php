<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this -> isMethod("post")) {
            return [
                "name"      => "required|min:3",
                "email"     => "required|email|unique:users",
                "password"  => "required|min:6|confirmed",
                "phones"    => "required|array",
                "activated" => "nullable",
            ];
        }

        return [
            "name"      => "required|min:3",
            "email"     => "required|email|unique:users,email," . $this -> user -> id,
            "password"  => "nullable|min:6|confirmed",
            "phones"    => "required|array",
            "activated" => "nullable"
        ];
    }
}
