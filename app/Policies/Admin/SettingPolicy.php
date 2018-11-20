<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Auth;

class SettingPolicy
{
    use HandlesAuthorization;

    const UPDATE = "setting:update";

    public function __construct()
    {

    }

    public function update() {
        return in_array(self::UPDATE, Auth::guard("admin") -> user() -> permissions);
    }
}
