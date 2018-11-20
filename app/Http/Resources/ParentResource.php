<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name"         => $this -> name,
            "email"        => $this -> email,
            "phone"        => $this -> phone,
            "api_token"    => $this -> api_token,
            "device_token" => $this -> device_token,
            
            
        ];
    }
}
