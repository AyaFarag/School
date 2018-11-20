<?php

namespace App\Http\Requests\Api\Teacher;

use App\Http\Requests\Api\AbstractRequest;

class QuizResponseAwardRequest extends AbstractRequest
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
            "points" => "required|numeric|min:1|max:" . $this -> quiz -> grade
        ];
    }

    public function requestAttributes() {
        return [
            "points"
        ];
    }
}
