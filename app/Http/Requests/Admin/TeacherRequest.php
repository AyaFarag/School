<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "branch_id"   => "required|exists:branches,id",
            "name"        => "required|string",
            "email"       => "required|email|unique:teachers",
            "password"    => "required|min:6|confirmed",
            "phone"       => "required|unique:teachers",
            "description" => "required|string",
            "address"     => "required|string",
            "birth_date"  => "required|date_format:Y-m-d",
            "nationality" => "required|string",
            "gender"      => "required|in:male,female,other"
        ];

        if ($this -> isMethod("put")) {
            $rules["phone"] = "required|unique:teachers,phone," . $this -> teacher -> id;
            $rules["email"] = "required|unique:teachers,email," . $this -> teacher -> id;
            $rules["password"] = "nullable|min:6|confirmed";
        }

        return $rules;
    }
}
