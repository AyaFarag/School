<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    abstract public function authorize();

    abstract public function rules();

    abstract public function requestAttributes();

    public function inputs()
    {
        return $this -> only($this -> requestAttributes());
    }

    public function without($key)
    {
        $inputs = $this -> inputs();
        if (array_key_exists($key, $inputs)) {
            unset($inputs[$key]);
        }
        return $inputs;
    }
}
