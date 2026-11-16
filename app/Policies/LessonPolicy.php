<?php

namespace App\Policies;

use App\Models\Lesson;
use App\Models\User;

class LessonPolicy
{
    public function before(User $u): ?bool
    {
        return $u->isAdmin() ? true : null;
    }

    public function view(User $u, Lesson $l): bool
    {
        return $l->section->course->instructor_id === $u->id;
    }

    public function update(User $u, Lesson $l): bool
    {
        return $this->view($u, $l);
    }

    public function delete(User $u, Lesson $l): bool
    {
        return $this->view($u, $l);
    }
}
