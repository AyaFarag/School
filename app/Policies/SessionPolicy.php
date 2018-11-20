<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Teacher;
use App\Models\Session;

class SessionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {}

    public function update(Teacher $teacher, Session $session) {
        return $teacher -> id === $session -> teacher_id;
    }
}
