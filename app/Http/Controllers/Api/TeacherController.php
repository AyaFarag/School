<?php

namespace App\Http\Controllers\Api;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TeacherRequest;
use App\Http\Resources\TeacherResource;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(TeacherRequest $request)
    {
        if (Auth::attempt($request -> only("email", "password"))) {
            $teacher = Auth::user();
            $teacher -> api_token = str_random(60);
            $teacher -> device_token = $request -> input("device_token");
            $teacher -> save();    
            return new TeacherResource($teacher);
        }
            
        return response()->json(["error" => trans("auth.failed")], 401);


        
    }

}
