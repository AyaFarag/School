<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Auth;

class UserPolicy
{
    use HandlesAuthorization;

    const VIEW   = "user:view";
    const CREATE = "user:create";
    const UPDATE = "user:update";
    const DELETE = "user:delete";

    public function __construct()
    {

    }

    public function view() {
        return in_array(self::VIEW, Auth::guard("admin") -> user() -> permissions);
    }

    public function create() {
        return in_array(self::CREATE, Auth::guard("admin") -> user() -> permissions);
    }

    public function update() {
        return in_array(self::UPDATE, Auth::guard("admin") -> user() -> permissions);
    }

    public function delete() {
        return in_array(self::DELETE, Auth::guard("admin") -> user() -> permissions);
    }
}
