<?php

namespace App\Http\Controllers\Api\Parent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;

use App\Http\Resources\ScheduleResource;

class ScheduleController extends Controller
{
    public function index(Request $request, Student $child) {
    	$class = $child -> classes() -> first();
    	$class -> load("semesterSessions.class.level", "semesterSessions.schedules", "semesterSessions.subject");
    	return new ScheduleResource($class -> semesterSessions);
    }
}
