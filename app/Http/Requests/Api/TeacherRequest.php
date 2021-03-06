<?php

namespace App\Http\Requests\Api;

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
        return [
            "email"        => "required|email",
            "password"     => "required",
            "device_token" => "nullable"
        ];
    }

    public function requestAttributes() {
        return [
            "email",
            "password",
            "device_token"
        ];
    }
}
