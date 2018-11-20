<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        if (Auth::attempt($request -> only("email", "password"))) {
            $user = Auth::user();
            $user -> api_token = str_random(60);
            $user -> device_token = $request -> input("device_token");
            $user -> save();

            return new UserResource($user);
        }

        return response()->json(["error" => trans("auth.failed")], 401);
    }

    public function register(RegisterRequest $request) {
        $user = new User($request -> all());
        $user -> api_token = str_random(60);
        $user -> activated = false;
        $user -> save();
        $user -> phones() -> createMany(array_map(function ($phone) {
            return compact("phone");
        }, $request -> input("phone_numbers")));

        return new UserResource($user);
    }
}
