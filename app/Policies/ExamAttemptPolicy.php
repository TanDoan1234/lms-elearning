<?php

namespace App\Policies;

use App\Models\ExamAttempt;
use App\Models\User;

class ExamAttemptPolicy
{
    public function view(User $user, ExamAttempt $attempt): bool
    {
        return $user->isAdmin()
            || $attempt->user_id === $user->id
            || ($user->isInstructor() && $attempt->exam()->whereHas('course', fn ($query) => $query->where('instructor_id', $user->id))->exists());
    }

    public function update(User $user, ExamAttempt $attempt): bool
    {
        return $attempt->user_id === $user->id && $attempt->status === 'in_progress';
    }
}
