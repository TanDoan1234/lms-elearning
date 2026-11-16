<?php

namespace Tests\Feature\Exams;

use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Question;
use App\Models\User;
use App\Services\ExamBuilderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExamManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_another_instructor_cannot_access_question_bank(): void
    {
        $owner = User::factory()->create(['role' => 'instructor']);
        $other = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $owner->id]);
        $this->actingAs($other)->get(route('instructor.courses.questions.index', $course))->assertForbidden();
    }

    public function test_owner_can_render_question_and_exam_pages(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $instructor->id]);
        $this->actingAs($instructor)->get(route('instructor.courses.questions.index', $course))->assertOk();
        $this->get(route('instructor.courses.exams.index', $course))->assertOk();
    }

    public function test_random_builder_selects_requested_difficulty_counts(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $instructor->id]);
        foreach (['easy' => 4, 'medium' => 3, 'hard' => 2] as $difficulty => $count) {
            for ($i = 0; $i < $count; $i++) {
                Question::create(['course_id' => $course->id, 'created_by' => $instructor->id, 'content' => "$difficulty $i", 'type' => 'single', 'difficulty' => $difficulty]);
            }
        }
        $exam = Exam::create(['course_id' => $course->id, 'title' => 'Kiểm tra', 'duration_minutes' => 30, 'pass_score' => 50, 'max_attempts' => 1, 'shuffle_questions' => true, 'is_final' => false, 'status' => 'draft']);

        app(ExamBuilderService::class)->random($exam, ['easy' => 3, 'medium' => 2, 'hard' => 1]);

        $this->assertSame(3, $exam->questions()->where('difficulty', 'easy')->count());
        $this->assertSame(2, $exam->questions()->where('difficulty', 'medium')->count());
        $this->assertSame(1, $exam->questions()->where('difficulty', 'hard')->count());
        $this->assertSame([1, 2, 3, 4, 5, 6], $exam->questions()->pluck('exam_question.position')->all());
    }

    public function test_manual_builder_keeps_order_and_points(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $course = Course::factory()->create(['instructor_id' => $instructor->id]);
        $questions = collect(range(1, 2))->map(fn ($i) => Question::create(['course_id' => $course->id, 'created_by' => $instructor->id, 'content' => "Câu $i", 'type' => 'single', 'difficulty' => 'easy']));
        $exam = Exam::create(['course_id' => $course->id, 'title' => 'Kiểm tra', 'duration_minutes' => 30, 'pass_score' => 50, 'max_attempts' => 1, 'shuffle_questions' => true, 'is_final' => false, 'status' => 'draft']);
        app(ExamBuilderService::class)->manual($exam, [$questions[1]->id => ['selected' => true, 'points' => 2.5], $questions[0]->id => ['selected' => true, 'points' => 1]]);
        $this->assertSame([$questions[1]->id, $questions[0]->id], $exam->questions()->pluck('questions.id')->all());
        $this->assertSame([2.5, 1], $exam->questions()->pluck('exam_question.points')->all());
    }

    public function test_owner_can_export_exam_scores(): void
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $student = User::factory()->create(['role' => 'student']);
        $course = Course::factory()->create(['instructor_id' => $instructor->id]);
        $exam = Exam::create(['course_id' => $course->id, 'title' => 'Kiểm tra', 'duration_minutes' => 30, 'pass_score' => 50, 'max_attempts' => 1, 'shuffle_questions' => true, 'is_final' => false, 'status' => 'draft']);
        ExamAttempt::create(['exam_id' => $exam->id, 'user_id' => $student->id, 'started_at' => now()->subMinutes(10), 'expires_at' => now()->addMinutes(20), 'submitted_at' => now(), 'score' => 80, 'correct_count' => 8, 'total' => 10, 'passed' => true, 'status' => 'submitted']);
        $this->actingAs($instructor)->get(route('instructor.exams.scores.export', $exam))->assertOk()->assertHeader('content-disposition');
    }
}
