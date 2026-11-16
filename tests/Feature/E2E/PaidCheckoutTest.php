<?php

namespace Tests\Feature\E2E;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Order;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaidCheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_card_success_activates_enrollment_and_decline_keeps_it_pending(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        [$successCourse] = $this->paidCourse();
        $this->actingAs($student)->post(route('courses.enroll', $successCourse));
        $this->post(route('checkout.pay', $successCourse), ['method' => 'card', 'card_number' => '4242 4242 4242 4242'])
            ->assertRedirect(route('learn.show', $successCourse));
        $this->assertDatabaseHas('course_user', ['course_id' => $successCourse->id, 'user_id' => $student->id, 'status' => 'active']);

        [$declinedCourse, $privateLesson] = $this->paidCourse();
        $this->post(route('courses.enroll', $declinedCourse));
        $this->from(route('checkout.show', $declinedCourse))->post(route('checkout.pay', $declinedCourse),
            ['method' => 'card', 'card_number' => '4000 0000 0000 0002'])->assertSessionHas('error');
        $this->assertDatabaseHas('orders', ['course_id' => $declinedCourse->id, 'user_id' => $student->id, 'status' => 'pending']);
        $this->assertDatabaseHas('course_user', ['course_id' => $declinedCourse->id, 'user_id' => $student->id, 'status' => 'pending']);
        $this->get(route('learn.show', [$declinedCourse, $privateLesson]))->assertForbidden();
    }

    public function test_bank_transfer_stays_pending_until_admin_confirms(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $admin = User::factory()->create(['role' => 'admin']);
        [$course, $lesson] = $this->paidCourse();
        $this->actingAs($student)->post(route('courses.enroll', $course));
        $this->post(route('checkout.pay', $course), ['method' => 'bank_transfer'])->assertSessionHas('success');
        $order = Order::whereBelongsTo($student)->whereBelongsTo($course)->firstOrFail();
        $this->assertSame('pending', $order->status);
        $this->get(route('learn.show', [$course, $lesson]))->assertForbidden();

        $this->actingAs($admin)->patch(route('admin.orders.confirm', $order))->assertSessionHas('success');
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'status' => 'paid']);
        $this->actingAs($student)->get(route('learn.show', [$course, $lesson]))->assertOk();
    }

    private function paidCourse(): array
    {
        $course = Course::factory()->create(['price' => 499000, 'status' => 'published']);
        $section = Section::create(['course_id' => $course->id, 'title' => 'Chương', 'position' => 1]);
        $lesson = Lesson::create(['section_id' => $section->id, 'title' => 'Bài riêng', 'type' => 'video', 'position' => 1]);

        return [$course, $lesson];
    }
}
