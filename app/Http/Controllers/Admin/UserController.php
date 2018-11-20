<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\UserRequest;

use App\Models\User;

use Session;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this -> authorize("view", User::class);

        if ($request -> filled("query")) {
            $users = User::search($request -> input("query"))
                -> withTrashed();
        } else {
            $users = User::withTrashed();
        }

        $users = $users -> latest() -> paginate();

        return view("admin.user.index", compact("users"));
    }

    public function create()
    {
        $this -> authorize("create", User::class);

        return view("admin.user.create");
    }

    public function store(UserRequest $request)
    {
        $this -> authorize("create", User::class);


        $user = new User();
        $user -> fill($request -> all());
        $user -> activated = $request -> filled("activated");
        $user -> save();

        Session::flash("success", "User was added successfully!");

        return redirect() -> route("admin.user.index");
    }

    public function edit(User $user)
    {
        $this -> authorize("update", User::class);

        return view("admin.user.edit", compact("user"));
    }

    public function update(UserRequest $request, User $user)
    {
        $this -> authorize("update", User::class);

        $user -> fill($request -> all());
        $user -> activated = $request -> filled("activated");
        if ($request -> filled("password"))
            $user -> password = $request -> input("password");
        $user -> save();

        Session::flash("success", "User was updated successfully!");

        return redirect() -> route("admin.user.edit", $user -> id);
    }

    public function destroy(User $user)
    {
        $this -> authorize("delete", User::class);

        $user -> delete();

        Session::flash("success", "User was deleted successfully!");

        return redirect() -> route("admin.user.index");
    }
}
