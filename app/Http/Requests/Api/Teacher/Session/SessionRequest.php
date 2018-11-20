<?php

namespace App\Http\Requests\Api\Teacher\Session;

use App\Http\Requests\Api\AbstractRequest;

class SessionRequest extends AbstractRequest
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
            "absent_students"   => "required|array",
            // validate if the students are part of the class associated with the session_id
            "absent_students.*.id"             => "required|exists:students,id",
            "absent_students.*.has_permission" => "required|boolean",
            "student_of_day_id"                => "exists:students,id"
        ];
    }

    public function requestAttributes() {
        return [
            "absent_students",
            "absent_students.*.id",
            "absent_students.*.has_permission",
            "student_of_day_id"
        ];
    }
}