<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "name"          => $this -> name,
            "email"         => $this -> email,
            "activated"     => $this -> activated,
            "api_token"     => $this -> api_token,
            "device_token"  => $this -> device_token,
            "phone_numbers" => UserPhoneResource::collection($this -> phones)
        ];
    }
}
