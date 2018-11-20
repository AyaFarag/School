<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\ModeratorRequest;

use App\Models\Admin;

use Session;

class ModeratorController extends Controller
{
    public function index(Request $request)
    {
        $this -> authorize("view", Admin::class);

        if ($request -> filled("query")) {
            $moderators = Admin::search($request -> input("query"))
                -> latest();
        } else {
            $moderators = Admin::latest();
        }

        $moderators = $moderators -> paginate();

        return view("admin.moderator.index", compact("moderators"));
    }

    public function create()
    {
        $this -> authorize("create", Admin::class);

        return view("admin.moderator.create");
    }

    public function store(ModeratorRequest $request)
    {
        $this -> authorize("create", Admin::class);

        $moderator = new Admin();
        $moderator -> fill($request -> all());
        $moderator -> save();

        Session::flash("success", "Moderator was added successfully!");

        return redirect() -> route("admin.moderator.index");
    }

    public function edit(Admin $moderator)
    {
        $this -> authorize("update", Admin::class);

        return view("admin.moderator.edit", compact("moderator"));
    }

    public function update(ModeratorRequest $request, Admin $moderator)
    {
        $this -> authorize("update", Admin::class);

        $moderator -> fill($request -> all());
        if ($request -> filled("password"))
            $moderator -> password = $request -> input("password");
        $moderator -> save();

        Session::flash("success", "Moderator was updated successfully!");

        return redirect() -> route("admin.moderator.edit", $moderator -> id);
    }

    public function destroy(Admin $moderator)
    {
        $this -> authorize("delete", Admin::class);

        $moderator -> delete();

        Session::flash("success", "Moderator was deleted successfully!");

        return redirect() -> route("admin.moderator.index");
    }
}
