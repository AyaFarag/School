<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = "/admin/dashboard";

    public function __construct()
    {
        $this -> middleware("guest:admin") -> except("logout");
    }


    public function showLoginForm()
    {
        return view("admin.auth.login");
    }


    public function guard()
    {
        return Auth::guard("admin");
    }

    public function logout(Request $request)
    {
        $this -> guard() -> logout();

        $request -> session() -> invalidate();

        return $this -> loggedOut($request) ?: redirect() -> route("admin.login");
    }
}
