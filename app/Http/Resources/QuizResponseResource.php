<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizResponseResource extends JsonResource
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
            "content"    => $this -> content,
            "points"     => $this -> points,
            "is_awarded" => !!$this -> points,
            "attachment" => $attachment ? url($attachment) : null,
            "student"    => (new StudentSnippetResource($this -> student)) -> only("id", "name")
        ];
    }
}
