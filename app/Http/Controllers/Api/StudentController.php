<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StudentRequest;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(StudentRequest $request)
    {
        
        if (Auth::attempt($request -> only("email", "password"))) {
            $student = Auth::user();
            $student -> api_token = str_random(60);
            $student -> device_token = $request -> input("device_token");
            $student -> save();
            return new StudentResource($student);
        }
    
        return response()->json(["error" => trans("auth.failed")], 401);
    }
}
