<?php

namespace Tests\Feature\E2E;

use App\Models\Course;
use App\Models\Exam;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IntegrationGuardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_private_lesson_redirects_to_login_and_unenrolled_student_is_forbidden(): void
    {
        [$course, $lesson] = $this->courseWithLesson();

        $this->get(route('learn.show', [$course, $lesson]))->assertRedirect(route('login'));
        $this->actingAs(User::factory()->create(['role' => 'student']))
            ->get(route('learn.show', [$course, $lesson]))->assertForbidden();
    }

    public function test_draft_course_cannot_be_enrolled_and_paid_course_is_never_activated_for_free(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $draft = Course::factory()->create(['status' => 'draft', 'price' => 0]);
        $paid = Course::factory()->create(['status' => 'published', 'price' => 499000]);

        $this->actingAs($student)->post(route('courses.enroll', $draft))->assertNotFound();
        $this->actingAs($student)->post(route('courses.enroll', $paid))->assertRedirect(route('checkout.show', $paid));
        $this->assertDatabaseHas('course_user', ['user_id' => $student->id, 'course_id' => $paid->id, 'status' => 'pending']);
    }

    public function test_exam_without_questions_cannot_start_and_used_question_cannot_be_deleted(): void
    {
        $student = User::factory()->create(['role' => 'student']);
        $course = Course::factory()->create();
        $course->students()->attach($student, ['status' => 'active', 'enrolled_at' => now()]);
        $exam = Exam::create(['course_id' => $course->id, 'title' => 'Đề rỗng', 'duration_minutes' => 30,
            'pass_score' => 50, 'max_attempts' => 1, 'status' => 'published']);

        $this->actingAs($student)->from(route('exams.show', $exam))->post(route('exams.start', $exam))
            ->assertRedirect(route('exams.show', $exam))->assertSessionHas('error');

        $question = Question::create(['course_id' => $course->id, 'created_by' => $course->instructor_id,
            'content' => 'Không được xoá', 'type' => 'single', 'difficulty' => 'easy']);
        $question->options()->createMany([['content' => 'Đúng', 'is_correct' => true], ['content' => 'Sai', 'is_correct' => false]]);
        $exam->questions()->attach($question, ['points' => 1, 'position' => 1]);
        $this->actingAs($course->instructor)->from(route('instructor.courses.questions.show', [$course, $question]))
            ->delete(route('instructor.courses.questions.destroy', [$course, $question]))
            ->assertSessionHas('error');
        $this->assertDatabaseHas('questions', ['id' => $question->id]);
    }

    private function courseWithLesson(): array
    {
        $course = Course::factory()->create();
        $section = Section::create(['course_id' => $course->id, 'title' => 'Chương 1', 'position' => 1]);
        $lesson = Lesson::create(['section_id' => $section->id, 'title' => 'Bài riêng tư', 'type' => 'video', 'position' => 1]);

        return [$course, $lesson];
    }
}
