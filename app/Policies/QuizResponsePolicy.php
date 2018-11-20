<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Teacher;
use App\Models\QuizResponse;

class QuizResponsePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {}

    public function update($user, QuizResponse $quiz_response) {
        if ($user instanceof Teacher)
            return $quiz_response -> quiz -> session -> teacher_id === $user -> id;
    }
}
