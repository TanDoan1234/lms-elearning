<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function before(User $u): ?bool
    {
        return $u->isAdmin() ? true : null;
    }

    public function viewAny(User $u): bool
    {
        return $u->isInstructor();
    }

    public function view(User $u, Course $c): bool
    {
        return $c->instructor_id === $u->id;
    }

    public function create(User $u): bool
    {
        return $u->isInstructor();
    }

    public function update(User $u, Course $c): bool
    {
        return $this->view($u, $c);
    }

    public function delete(User $u, Course $c): bool
    {
        return $this->view($u, $c);
    }
}
