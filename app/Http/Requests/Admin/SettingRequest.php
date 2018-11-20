<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "social_networks" => "required|array|min:1",
            "phone_numbers"   => "required|array|min:1",
            "websites"        => "required|array|min:1",
            "emails"          => "required|array|min:1",
            "addresses"       => "required|array|min:1",
        ];
    }
}
