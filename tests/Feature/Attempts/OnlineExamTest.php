<?php

namespace Tests\Feature\Attempts;

use App\Livewire\Exam\TakeExam;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Section;
use App\Models\User;
use App\Services\CertificateService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class OnlineExamTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_start_answer_and_submit_single_and_multiple_questions(): void
    {
        [$student, $course, $exam] = $this->examFixture();
        [$single, $singleCorrect] = $this->question($course, 'single', [true, false]);
        [$multiple, $multipleCorrect] = $this->question($course, 'multiple', [true, true, false]);
        $exam->questions()->attach([$single->id => ['points' => 1, 'position' => 1], $multiple->id => ['points' => 2, 'position' => 2]]);

        $this->actingAs($student)->post(route('exams.start', $exam))->assertRedirect();
        $attempt = ExamAttempt::firstOrFail();

        Livewire::actingAs($student)->test(TakeExam::class, ['attempt' => $attempt])
            ->call('selectOption', $singleCorrect[0])
            ->call('next')
            ->call('selectOption', $multipleCorrect[0])
            ->call('selectOption', $multipleCorrect[1])
            ->call('submit');

        $attempt->refresh();
        $this->assertSame('submitted', $attempt->status);
        $this->assertSame('100.00', $attempt->score);
        $this->assertTrue($attempt->passed);
        $this->assertSame(2, $attempt->correct_count);
    }

    public function test_saving_after_expiry_is_rejected_and_attempt_is_finalized(): void
    {
        [$student, $course, $exam] = $this->examFixture();
        [$question, $correct] = $this->question($course, 'single', [true, false]);
        $exam->questions()->attach($question, ['points' => 1, 'position' => 1]);
        $attempt = $this->attempt($student, $exam, [$question->id], now()->subSeconds(6));

        Livewire::actingAs($student)->test(TakeExam::class, ['attempt' => $attempt])
            ->assertRedirect(route('attempts.result', $attempt));

        $this->assertSame('submitted', $attempt->fresh()->status);
        $this->assertSame([], $attempt->answers()->firstOrFail()->selected_option_ids);
    }

    public function test_max_attempts_is_enforced(): void
    {
        [$student, , $exam] = $this->examFixture(['max_attempts' => 1]);
        ExamAttempt::create(['exam_id' => $exam->id, 'user_id' => $student->id, 'started_at' => now()->subHour(), 'expires_at' => now()->subMinutes(30), 'submitted_at' => now(), 'status' => 'submitted']);

        $this->actingAs($student)->from(route('exams.show', $exam))->post(route('exams.start', $exam))
            ->assertRedirect(route('exams.show', $exam))->assertSessionHas('error');
        $this->assertCount(1, $exam->attempts);
    }

    public function test_another_student_cannot_access_attempt(): void
    {
        [$student, $course, $exam] = $this->examFixture();
        $other = User::factory()->create(['role' => 'student']);
        $course->students()->attach($other, ['status' => 'active', 'enrolled_at' => now()]);
        [$question] = $this->question($course, 'single', [true, false]);
        $attempt = $this->attempt($student, $exam, [$question->id], now()->addHour());

        $this->actingAs($other)->get(route('attempts.take', $attempt))->assertForbidden();
        $this->actingAs($other)->get(route('attempts.result', $attempt))->assertForbidden();
    }

    public function test_certificate_is_issued_only_when_eligible_and_pdf_exists(): void
    {
        Storage::fake('public');
        [$student, $course, $exam] = $this->examFixture(['is_final' => true]);
        $section = Section::create(['course_id' => $course->id, 'title' => 'Phần 1', 'position' => 1]);
        $lesson = Lesson::create(['section_id' => $section->id, 'title' => 'Bài 1', 'type' => 'video', 'position' => 1]);

        $service = app(CertificateService::class);
        $this->assertNull($service->issueIfEligible($student, $course));
        $student->completedLessons()->attach($lesson, ['completed_at' => now()]);
        $this->assertNull($service->issueIfEligible($student, $course));
        ExamAttempt::create(['exam_id' => $exam->id, 'user_id' => $student->id, 'started_at' => now()->subMinute(), 'expires_at' => now()->addHour(), 'submitted_at' => now(), 'score' => 100, 'passed' => true, 'status' => 'submitted']);

        $certificate = $service->issueIfEligible($student, $course);
        $this->assertNotNull($certificate);
        Storage::disk('public')->assertExists($certificate->file_path);
        $this->assertStringStartsWith('%PDF', Storage::disk('public')->get($certificate->file_path));
    }

    public function test_verify_page_handles_valid_and_invalid_codes(): void
    {
        [$student, $course] = $this->examFixture();
        $certificate = Certificate::create(['user_id' => $student->id, 'course_id' => $course->id, 'code' => 'LMS-2026-VALID01', 'issued_at' => now()]);

        $this->get(route('certificates.verify', $certificate->code))->assertOk()->assertSee('CHỨNG CHỈ HỢP LỆ')->assertSee($student->name);
        $this->get(route('certificates.verify', 'INVALID'))->assertOk()->assertSee('Không tìm thấy chứng chỉ');
    }

    private function examFixture(array $examOverrides = []): array
    {
        $instructor = User::factory()->create(['role' => 'instructor']);
        $student = User::factory()->create(['role' => 'student']);
        $category = Category::create(['name' => 'Danh mục', 'slug' => 'danh-muc']);
        $course = Course::create(['instructor_id' => $instructor->id, 'category_id' => $category->id, 'title' => 'Laravel', 'slug' => 'laravel', 'price' => 0, 'status' => 'published']);
        $course->students()->attach($student, ['status' => 'active', 'enrolled_at' => now()]);
        $exam = Exam::create(array_merge(['course_id' => $course->id, 'title' => 'Thi cuối khóa', 'duration_minutes' => 30, 'pass_score' => 60, 'max_attempts' => 3, 'shuffle_questions' => false, 'is_final' => false, 'status' => 'published'], $examOverrides));

        return [$student, $course, $exam];
    }

    private function question(Course $course, string $type, array $correctFlags): array
    {
        $question = Question::create(['course_id' => $course->id, 'created_by' => $course->instructor_id, 'content' => 'Câu hỏi '.$type, 'type' => $type, 'difficulty' => 'easy']);
        $correct = [];
        foreach ($correctFlags as $index => $isCorrect) {
            $option = $question->options()->create(['content' => 'Đáp án '.($index + 1), 'is_correct' => $isCorrect]);
            if ($isCorrect) {
                $correct[] = $option->id;
            }
        }

        return [$question, $correct];
    }

    private function attempt(User $student, Exam $exam, array $questionIds, $expiresAt): ExamAttempt
    {
        $attempt = ExamAttempt::create(['exam_id' => $exam->id, 'user_id' => $student->id, 'started_at' => now()->subMinute(), 'expires_at' => $expiresAt, 'question_order' => $questionIds]);
        foreach ($questionIds as $id) {
            $attempt->answers()->create(['question_id' => $id, 'selected_option_ids' => []]);
        }

        return $attempt->fresh();
    }
}
