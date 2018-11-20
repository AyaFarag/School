<?php

namespace App\Http\Requests\Api\Teacher\Session;

use App\Http\Requests\Api\AbstractRequest;

class SessionStartRequest extends AbstractRequest
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
            "semester_session_id" => "required|exists:semester_sessions,id"
        ];
    }

    public function requestAttributes() {
        return [
            "semester_session_id"
        ];
    }
}
