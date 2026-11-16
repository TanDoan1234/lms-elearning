<?php

namespace Tests\Feature\E2E;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuthorizationMatrixTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_every_protected_module(): void
    {
        $f = $this->fixture();
        foreach ($this->protectedUrls($f) as $url) {
            $this->get($url)->assertRedirect(route('login'));
        }
    }

    public function test_student_other_instructor_owner_instructor_and_admin_matrix(): void
    {
        $f = $this->fixture();
        $studentCases = [
            route('admin.dashboard') => 403,
            route('instructor.courses.index') => 403,
            route('instructor.courses.questions.index', $f['course']) => 403,
            route('instructor.exams.results', $f['exam']) => 403,
            route('learn.show', [$f['course'], $f['lesson']]) => 200,
            route('attempts.take', $f['attempt']) => 200,
            route('certificates.download', $f['certificate']) => 200,
        ];
        $this->assertMatrix($f['student'], $studentCases);

        foreach ([$f['otherInstructor'], $f['owner']] as $index => $instructor) {
            $owner = $index === 1;
            $this->assertMatrix($instructor, [
                route('admin.dashboard') => 403,
                route('instructor.courses.index') => 200,
                route('instructor.courses.show', $f['course']) => $owner ? 200 : 403,
                route('instructor.courses.questions.index', $f['course']) => $owner ? 200 : 403,
                route('instructor.exams.results', $f['exam']) => $owner ? 200 : 403,
                route('learn.show', [$f['course'], $f['lesson']]) => 403,
                route('attempts.take', $f['attempt']) => 403,
                route('certificates.download', $f['certificate']) => 403,
            ]);
        }

        $this->assertMatrix($f['admin'], [
            route('admin.dashboard') => 200,
            route('instructor.courses.index') => 200,
            route('instructor.courses.show', $f['course']) => 200,
            route('instructor.courses.questions.index', $f['course']) => 200,
            route('instructor.exams.results', $f['exam']) => 200,
            route('learn.show', [$f['course'], $f['lesson']]) => 403,
            route('attempts.take', $f['attempt']) => 403,
            route('certificates.download', $f['certificate']) => 200,
        ]);
    }

    private function assertMatrix(User $user, array $cases): void
    {
        foreach ($cases as $url => $status) {
            $this->actingAs($user)->get($url)->assertStatus($status);
        }
    }

    private function protectedUrls(array $f): array
    {
        return [route('admin.dashboard'), route('instructor.courses.index'),
            route('instructor.courses.questions.index', $f['course']), route('instructor.exams.results', $f['exam']),
            route('learn.show', [$f['course'], $f['lesson']]), route('attempts.take', $f['attempt']),
            route('certificates.download', $f['certificate'])];
    }

    private function fixture(): array
    {
        Storage::fake('public');
        $owner = User::factory()->create(['role' => 'instructor']);
        $otherInstructor = User::factory()->create(['role' => 'instructor']);
        $student = User::factory()->create(['role' => 'student']);
        $admin = User::factory()->create(['role' => 'admin']);
        $course = Course::factory()->create(['instructor_id' => $owner->id]);
        $course->students()->attach($student, ['status' => 'active', 'enrolled_at' => now()]);
        $section = Section::create(['course_id' => $course->id, 'title' => 'Chương', 'position' => 1]);
        $lesson = Lesson::create(['section_id' => $section->id, 'title' => 'Bài', 'type' => 'video', 'position' => 1]);
        $question = Question::create(['course_id' => $course->id, 'created_by' => $owner->id,
            'content' => 'Câu hỏi', 'type' => 'single', 'difficulty' => 'easy']);
        $question->options()->createMany([['content' => 'A', 'is_correct' => true], ['content' => 'B', 'is_correct' => false]]);
        $exam = Exam::create(['course_id' => $course->id, 'title' => 'Đề', 'duration_minutes' => 30,
            'pass_score' => 50, 'max_attempts' => 2, 'status' => 'published']);
        $exam->questions()->attach($question, ['points' => 1, 'position' => 1]);
        $attempt = ExamAttempt::create(['exam_id' => $exam->id, 'user_id' => $student->id,
            'started_at' => now(), 'expires_at' => now()->addHour(), 'question_order' => [$question->id]]);
        $attempt->answers()->create(['question_id' => $question->id, 'selected_option_ids' => []]);
        $certificate = Certificate::create(['user_id' => $student->id, 'course_id' => $course->id,
            'code' => 'LMS-MATRIX', 'issued_at' => now(), 'file_path' => 'certificates/matrix.pdf']);
        Storage::disk('public')->put($certificate->file_path, '%PDF matrix');

        return compact('owner', 'otherInstructor', 'student', 'admin', 'course', 'lesson', 'exam', 'attempt', 'certificate');
    }
}
