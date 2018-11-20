<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\SettingRequest;

use App\Models\Setting;

use Session;

class SettingController extends Controller
{
    public function edit() {
        $this -> authorize("update", Setting::class);

        $setting = Setting::first();

        return view("admin.setting.edit", compact("setting"));
    }

    public function update(SettingRequest $request) {
        $this -> authorize("update", Setting::class);

        $setting = Setting::first();

        $setting -> social_networks = array_filter($request -> input("social_networks"));
        $setting -> phone_numbers   = array_filter($request -> input("phone_numbers"));
        $setting -> websites        = array_filter($request -> input("websites"));
        $setting -> emails          = array_filter($request -> input("emails"));
        $setting -> addresses       = array_filter($request -> input("addresses"));

        $setting -> save();

        Session::flash("success", "Settings were updated successfully!");

        return redirect() -> route("admin.setting.edit");
    }
}
