<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SemesterSessionRequest extends FormRequest
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
            "teacher_id" => "required|exists:teachers,id",
            "class_id"   => "required|exists:classes,id",
            "subject_id" => "required|exists:subjects,id",
            "year_id"    => "required|exists:years,id"
        ];
    }
}
