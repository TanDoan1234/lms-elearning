<?php

namespace Tests\Feature\Content;

use App\Models\Category;
use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_categories_and_users(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->post(route('admin.categories.store'), ['name' => 'Lập trình Web', 'description' => 'Mô tả'])->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['slug' => 'lap-trinh-web']);
        $this->actingAs($admin)->post(route('admin.users.store'), ['name' => 'Giảng viên mới', 'email' => 'new@example.test', 'role' => 'instructor', 'password' => 'password', 'password_confirmation' => 'password'])->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['email' => 'new@example.test', 'role' => 'instructor']);
    }

    public function test_user_index_has_create_modal_that_reopens_with_errors(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $index = route('admin.users.index');

        $this->actingAs($admin)->get($index)->assertOk()
            ->assertSee('open-modal', false)->assertSee('name="_modal" value="create-user"', false)
            ->assertSee('Tạo người dùng')->assertSee('Hiện mật khẩu');

        $this->actingAs($admin)->from($index)->post(route('admin.users.store'), [
            '_modal' => 'create-user', 'name' => 'Người mới', 'email' => 'bad', 'role' => 'student',
            'password' => 'password', 'password_confirmation' => 'different',
        ])->assertRedirect($index)->assertSessionHasErrors(['email', 'password']);
        $this->assertDatabaseMissing('users', ['name' => 'Người mới']);

        // The modal is rendered open (display: block) and keeps the typed name after a failed submit.
        $this->actingAs($admin)->get($index)->assertOk()
            ->assertSee('style="display: block;"', false)->assertSee('value="Người mới"', false)
            ->assertSee('Email không hợp lệ.');
    }

    public function test_password_inputs_render_visibility_toggle(): void
    {
        $this->get(route('login'))->assertOk()->assertSee('Hiện mật khẩu')->assertSee("show ? 'text' : 'password'", false);
        $this->get(route('register'))->assertOk()->assertSee('Hiện mật khẩu');
    }

    public function test_non_admin_is_forbidden_and_admin_cannot_delete_self(): void
    {
        $student = User::factory()->create();
        $this->actingAs($student)->get(route('admin.dashboard'))->assertForbidden();
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin)->delete(route('admin.users.destroy', $admin))->assertSessionHas('error');
        $this->assertModelExists($admin);
    }

    public function test_admin_can_toggle_course_and_confirm_order(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $instructor = User::factory()->create(['role' => 'instructor']);
        $student = User::factory()->create();
        $category = Category::factory()->create();
        $course = Course::factory()->create(['instructor_id' => $instructor, 'category_id' => $category, 'status' => 'draft']);
        $this->actingAs($admin)->patch(route('admin.courses.toggle-status', $course))->assertSessionHas('success');
        $this->assertSame('published', $course->fresh()->status);
        $order = Order::create(['user_id' => $student->id, 'course_id' => $course->id, 'code' => 'ORD-TEST', 'amount' => 100000, 'status' => 'pending']);
        $this->actingAs($admin)->patch(route('admin.orders.confirm', $order))->assertSessionHas('success');
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'paid']);
        $this->assertDatabaseHas('course_user', ['user_id' => $student->id, 'course_id' => $course->id, 'status' => 'active']);
    }
}
