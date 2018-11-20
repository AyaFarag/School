<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            "day"  => "required|in:saturday,sunday,monday,tuesday,wednesday,thursday,friday",
            "from" => "required|date_format:H:i",
            "to"   => "required|date_format:H:i"
        ];
    }
}
