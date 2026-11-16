<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function before(User $u): ?bool
    {
        return $u->isAdmin() ? true : null;
    }

    public function viewAny(User $u): bool
    {
        return false;
    }

    public function view(User $u, User $m): bool
    {
        return false;
    }

    public function create(User $u): bool
    {
        return false;
    }

    public function update(User $u, User $m): bool
    {
        return false;
    }

    public function delete(User $u, User $m): bool
    {
        return false;
    }
}
