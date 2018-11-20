<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use Auth;

class AdminProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $admin = Auth::guard("admin") -> user();
        return [
            "name" => "required",
            "email" => "required|unique:admins,email," . $admin -> id,
            "password" => "nullable|confirmed|min:6"
        ];
    }
}
