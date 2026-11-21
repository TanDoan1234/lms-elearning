<?php

namespace Tests\Concerns;

use App\Models\Category;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Question;
use App\Models\User;

trait ExamFixtures
{
    /** @return array{0: User, 1: Course, 2: Exam, 3: User} student, course, exam, instructor */
    protected function examFixture(array $examOverrides = [], int $questionCount = 1): array
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $student = User::factory()->create(['role' => 'student']);
        $category = Category::create(['name' => 'Danh mục', 'slug' => 'danh-muc']);
        $course = Course::create(['instructor_id' => $instructor->id, 'category_id' => $category->id, 'title' => 'Laravel', 'slug' => 'laravel', 'price' => 0, 'status' => 'published']);
        $course->students()->attach($student, ['status' => 'active', 'enrolled_at' => now()]);
        $exam = Exam::create(array_merge(['course_id' => $course->id, 'title' => 'Bài thi', 'duration_minutes' => 30, 'pass_score' => 60, 'max_attempts' => 3, 'shuffle_questions' => false, 'is_final' => false, 'status' => 'published'], $examOverrides));

        for ($i = 0; $i < $questionCount; $i++) {
            $question = Question::create(['course_id' => $course->id, 'created_by' => $instructor->id, 'content' => 'Câu hỏi '.($i + 1), 'type' => 'single', 'difficulty' => 'easy']);
            $question->options()->create(['content' => 'Đúng', 'is_correct' => true]);
            $question->options()->create(['content' => 'Sai', 'is_correct' => false]);
            $exam->questions()->attach($question->id, ['points' => 1, 'position' => $i + 1]);
        }

        return [$student, $course, $exam, $instructor];
    }

    protected function startedAttempt(User $student, Exam $exam, $startedAt = null, $expiresAt = null): ExamAttempt
    {
        $startedAt ??= now();
        $questionIds = $exam->questions()->pluck('questions.id')->all();
        $attempt = ExamAttempt::create(['exam_id' => $exam->id, 'user_id' => $student->id, 'started_at' => $startedAt, 'expires_at' => $expiresAt ?? $exam->deadlineFor($startedAt), 'question_order' => $questionIds]);
        foreach ($questionIds as $id) {
            $attempt->answers()->create(['question_id' => $id, 'selected_option_ids' => []]);
        }

        return $attempt->fresh();
    }

    protected function validExamPayload(array $overrides = []): array
    {
        return array_merge([
            'title' => 'Đề mới', 'duration_minutes' => 30, 'pass_score' => 50, 'max_attempts' => 2,
            'status' => 'published', 'selection_mode' => 'random',
            'random' => ['easy' => 1, 'medium' => 0, 'hard' => 0],
        ], $overrides);
    }
}
