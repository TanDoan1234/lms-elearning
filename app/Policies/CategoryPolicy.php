<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;

class CategoryPolicy
{
    public function before(User $u): ?bool
    {
        return $u->isAdmin() ? true : null;
    }

    public function viewAny(User $u): bool
    {
        return false;
    }

    public function view(User $u, Category $c): bool
    {
        return false;
    }

    public function create(User $u): bool
    {
        return false;
    }

    public function update(User $u, Category $c): bool
    {
        return false;
    }

    public function delete(User $u, Category $c): bool
    {
        return false;
    }
}
