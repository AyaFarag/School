<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Admin;

use Auth;

class ModeratorRequest extends FormRequest
{

    public function authorize()
    {
        $action = "create";

        if ($this -> isMethod("put"))
            $action = "update";

        return Auth::user() -> can($action, Admin::class);
    }

    public function rules()
    {
        if ($this -> isMethod("post")) {
            return [
                "name"        => "required|min:3",
                "email"       => "required|email|unique:admins",
                "password"    => "required|min:6|confirmed",
                "permissions" => "required|array"
            ];
        }

        return [
            "name"        => "required|min:3",
            "email"       => "required|email|unique:admins,email," . $this -> moderator -> id,
            "password"    => "nullable|min:6|confirmed",
            "permissions" => "required|array"
        ];
    }
}
