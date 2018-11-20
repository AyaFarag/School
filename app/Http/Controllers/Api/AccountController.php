<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Events\PhoneActivationRequest;

use App\Models\User;
use App\Models\UserPhone;

use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;

use App\Http\Resources\UserResource;

use Auth;

class AccountController extends Controller
{
    public function sendPhoneActivationCode(Request $request) {
        $request -> validate(["phone" => "required|regex:/^[+\d]+$/"]);

        $user = Auth::user();
        $phone_number = $request -> input("phone");

        $oldPhone = $user -> phones -> first(function ($item) use ($phone_number) {
            return $item -> phone === $phone_number;
        });

        if ($oldPhone) {
            if ($oldPhone -> confirmed) {
                return response()
                    -> json(["message" => trans("api.phone_already_confirmed")], 403);
            }

            event(new PhoneActivationRequest($user, $oldPhone));
        } else {

            $phone = new UserPhone();
            $phone -> user_id = $user -> id;
            $phone -> phone = $phone_number;

            event(new PhoneActivationRequest($user, $phone));
        }

        return response()
            -> json(["message" => trans("api.activation_code_sent")], 200);
    }

    public function activatePhone(Request $request) {
        $request -> validate(["code" => "required"]);

        $user = Auth::user();

        $phone = $user -> phones()
            -> where("users_phones.confirmation_code", $request -> input("code"))
            -> first();

        if (!$phone) {
            return response()
            -> json([
                "message" => trans("api.invalid_phone_activation_code")
            ], 403);
        }

        $phone -> confirmed         = true;
        $phone -> confirmation_code = null;
        $phone -> save();

        $user -> activated = true;
        $user -> save();

        return response()
            -> json([
                "message" => trans("api.activated_successfully")
            ], 200);
    }
}
