<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->isInstructor();
    }

    public function view(User $user, Question $question): bool
    {
        return $question->course->instructor_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isInstructor();
    }

    public function update(User $user, Question $question): bool
    {
        return $this->view($user, $question);
    }

    public function delete(User $user, Question $question): bool
    {
        return $this->view($user, $question);
    }
}
