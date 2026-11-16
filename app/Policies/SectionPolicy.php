<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;

class SectionPolicy
{
    public function before(User $u): ?bool
    {
        return $u->isAdmin() ? true : null;
    }

    public function view(User $u, Section $s): bool
    {
        return $s->course->instructor_id === $u->id;
    }

    public function update(User $u, Section $s): bool
    {
        return $this->view($u, $s);
    }

    public function delete(User $u, Section $s): bool
    {
        return $this->view($u, $s);
    }
}
