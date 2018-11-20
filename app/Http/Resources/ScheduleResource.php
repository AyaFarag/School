<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $days = [
            "saturday"  => [],
            "sunday"    => [],
            "monday"    => [],
            "tuesday"   => [],
            "wednesday" => [],
            "thursday"  => [],
            "friday"    => []
        ];

        $this -> each(function ($semesterSession) use (&$days) {
            $semesterSession -> schedules -> each(function ($schedule) use (&$days, $semesterSession) {
                $days[$schedule -> day][] = [
                    "id" => $semesterSession -> id,
                    "class" => [
                        "id"   => $semesterSession -> class -> id,
                        "name" => $semesterSession -> class -> name
                    ],
                    "teacher" => [
                        "id"   => $semesterSession -> teacher -> id,
                        "name" => $semesterSession -> teacher -> name
                    ],
                    "level" => [
                        "id"   => $semesterSession -> class -> level -> id,
                        "name" => $semesterSession -> class -> level -> name
                    ],
                    "from" => $schedule -> from,
                    "to"   => $schedule -> to
                ];
            });
        });

        return $days;
    }
}
