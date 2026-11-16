<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;

class ExamPolicy
{
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    public function viewAny(User $user): bool
    {
        return $user->isInstructor();
    }

    public function view(User $user, Exam $exam): bool
    {
        return $exam->course->instructor_id === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->isInstructor();
    }

    public function update(User $user, Exam $exam): bool
    {
        return $this->view($user, $exam);
    }

    public function delete(User $user, Exam $exam): bool
    {
        return $this->view($user, $exam);
    }
}
