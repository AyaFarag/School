<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $attachment = $this -> getFirstMediaUrl("attachments");
        return [
            "id"         => $this -> id,
            "title"      => $this -> title,
            "content"    => $this -> content,
            "grade"      => $this -> grade,
            "attachment" => $attachment ? url($attachment) : null
        ];
    }
}
