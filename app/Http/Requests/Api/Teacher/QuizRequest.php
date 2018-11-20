<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\AbstractRequest;

class QuizRequest extends AbstractRequest
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
            "title"      => "required|string",
            "content"    => "required|string",
            "session_id" => "required|exists:sessions,id",
            "grade"      => "required|numeric|min:1",
            "attachment" => ($this -> isMethod("put") ? "nullable" : "required") . "|file"
        ];
    }

    public function requestAttributes() {
        return [
            "title",
            "content",
            "session_id",
            "grade",
            "attachment"
        ];
    }
}
