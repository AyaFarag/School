<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPhoneResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "phone"     => $this -> phone,
            "confirmed" => $this -> confirmed
        ];
    }
}
