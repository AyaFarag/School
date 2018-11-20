<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Auth;

class ModeratorPolicy
{
    use HandlesAuthorization;

    const VIEW   = "moderator:view";
    const CREATE = "moderator:create";
    const UPDATE = "moderator:update";
    const DELETE = "moderator:delete";

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
