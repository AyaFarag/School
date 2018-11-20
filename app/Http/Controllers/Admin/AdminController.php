<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin;

use App\Http\Requests\Admin\AdminProfileRequest;

use Session;
use Auth;

class AdminController extends Controller
{
    public function showProfile() {
        $admin = Auth::guard("admin") -> user();

        return view("admin.profile", compact("admin"));
    }

    public function updateProfile(AdminProfileRequest $request) {
        $admin = Auth::guard("admin") -> user();
        $admin -> name  = $request -> input("name");
        $admin -> email = $request -> input("email");
        if ($request -> filled("password"))
            $admin -> password = $request -> input("password");
        $admin -> save();

        Session::flash("success", "Your profile info was updated successfully!");

        return redirect() -> route("admin.profile");
    }
}
