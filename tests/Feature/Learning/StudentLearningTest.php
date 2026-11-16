<?php

namespace Tests\Feature\Learning;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use App\Services\ProgressService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentLearningTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_catalog_only_shows_published_courses(): void
    {
        $published = Course::factory()->create(['title' => 'Laravel thực chiến', 'status' => 'published']);
        Course::factory()->create(['title' => 'Khóa học bí mật', 'status' => 'draft']);
        $this->get(route('home'))->assertOk()->assertSee($published->title)->assertDontSee('Khóa học bí mật');
        $this->get(route('courses.show', $published))->assertOk();
    }

    public function test_free_course_is_activated_immediately(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = Course::factory()->create(['price' => 0]);
        $this->actingAs($student)->post(route('courses.enroll', $course))->assertRedirect(route('learn.show', $course));
        $this->assertDatabaseHas('course_user', ['user_id' => $student->id, 'course_id' => $course->id, 'status' => 'active']);
    }

    public function test_paid_course_card_payment_activates_enrollment(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = Course::factory()->create(['price' => 499000]);
        $this->actingAs($student)->post(route('courses.enroll', $course));
        $this->actingAs($student)->post(route('checkout.pay', $course), ['method' => 'card', 'card_number' => '4242 4242 4242 4242'])->assertRedirect(route('learn.show', $course));
        $this->assertDatabaseHas('orders', ['user_id' => $student->id, 'course_id' => $course->id, 'status' => 'paid']);
        $this->assertDatabaseHas('course_user', ['user_id' => $student->id, 'course_id' => $course->id, 'status' => 'active']);
    }

    public function test_unenrolled_student_cannot_open_private_lesson(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        [$course, $lesson] = $this->courseWithLesson(false);
        $this->actingAs($student)->get(route('learn.show', [$course, $lesson]))->assertForbidden();
    }

    public function test_completed_lesson_returns_json_and_updates_progress(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        [$course, $lesson] = $this->courseWithLesson(false);
        $student->enrolledCourses()->attach($course, ['status' => 'active', 'enrolled_at' => now()]);
        $this->actingAs($student)->postJson(route('lessons.complete', $lesson))->assertOk()->assertJson(['completed' => true, 'progress' => 100, 'course_completed' => true]);
        $this->assertDatabaseHas('lesson_user', ['user_id' => $student->id, 'lesson_id' => $lesson->id]);
        $this->assertNotNull($student->enrolledCourses()->find($course->id)->pivot->completed_at);
    }

    public function test_progress_service_returns_first_uncompleted_lesson(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        [$course, $first] = $this->courseWithLesson(false);
        $second = Lesson::create(['section_id' => $first->section_id, 'title' => 'Bài 2', 'type' => 'video', 'position' => 2, 'is_preview' => false]);

        $this->assertTrue(app(ProgressService::class)->nextLesson($student, $course)->is($first));
        $student->completedLessons()->attach($first, ['completed_at' => now()]);
        $this->assertTrue(app(ProgressService::class)->nextLesson($student, $course)->is($second));
    }

    private function courseWithLesson(bool $preview): array
    {
        $course = Course::factory()->create();
        $section = Section::create(['course_id' => $course->id, 'title' => 'Chương 1', 'position' => 1]);
        $lesson = Lesson::create(['section_id' => $section->id, 'title' => 'Bài 1', 'type' => 'video', 'position' => 1, 'is_preview' => $preview]);

        return [$course, $lesson];
    }
}
