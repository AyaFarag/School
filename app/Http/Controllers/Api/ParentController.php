<?php

namespace App\Http\Controllers\Api;

use App\Models\ParentModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParentsRequest;
use App\Http\Resources\ParentResource;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        
    public function login(ParentsRequest $request) {

        if (Auth::attempt($request -> only("email", "password"))) {
            $parent = Auth::user();
            $parent -> api_token = str_random(60);
            $parent -> device_token = $request -> input("device_token");
            $parent -> save();
            return new ParentResource($parent);
        }

        return response()->json(["error" => trans("auth.failed")], 401);

        }
}

