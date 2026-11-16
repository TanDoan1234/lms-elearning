<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleRedirectTest extends TestCase
{
    use RefreshDatabase;

    public function test_each_role_lands_on_its_dashboard_after_login(): void
    {
        $accounts = [
            ['admin', 'admin@lms.test', 'admin.dashboard'],
            ['instructor', 'gv1@lms.test', 'instructor.dashboard'],
            ['student', 'hv1@lms.test', 'student.dashboard'],
        ];

        foreach ($accounts as [$role, $email, $route]) {
            $user = User::factory()->create(['role' => $role, 'email' => $email]);
            $response = $this->post('/login', ['email' => $user->email, 'password' => 'password']);
            $response->assertRedirect(route('dashboard', absolute: false));
            $this->get('/dashboard')->assertRedirect(route($route, absolute: false));
            auth()->logout();
        }
    }
}
