<?php

namespace Tests\Feature\Exams;

use App\Livewire\Exam\TakeExam;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\CertificateService;
use App\Services\ExamGradingService;
use Livewire\Livewire;
use Tests\Concerns\ExamFixtures;
use Tests\TestCase;

class ExamScheduleTest extends TestCase
{
    use ExamFixtures, RefreshDatabase;

    public function test_student_cannot_start_before_window_opens(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture(['starts_at' => now()->addDay()]);

        $this->actingAs($student)->post(route('exams.start', $exam))->assertSessionHas('error');
        $this->assertSame(0, ExamAttempt::count());
    }

    public function test_student_cannot_start_after_window_closes(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture(['ends_at' => now()->subMinute()]);

        $this->actingAs($student)->post(route('exams.start', $exam))->assertSessionHas('error', 'Bài thi đã đóng, không thể bắt đầu lượt làm mới.');
        $this->assertSame(0, ExamAttempt::count());
    }

    public function test_start_inside_window_caps_deadline_at_closing_time(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture(['starts_at' => now()->subHour(), 'ends_at' => now()->addMinutes(10), 'duration_minutes' => 30]);

        $this->actingAs($student)->post(route('exams.start', $exam))->assertRedirect();

        $attempt = ExamAttempt::firstOrFail();
        $this->assertSame($exam->ends_at->timestamp, $attempt->expires_at->timestamp);
    }

    public function test_in_progress_attempt_is_auto_submitted_when_exam_closes(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture(['ends_at' => now()->addMinutes(10)]);
        $attempt = $this->startedAttempt($student, $exam);
        $this->actingAs($student);

        $component = Livewire::test(TakeExam::class, ['attempt' => $attempt]);
        $optionId = $exam->questions->first()->options->first()->id;

        $this->travel(11)->minutes();

        $component->call('selectOption', $optionId)->assertStatus(409);
        $this->assertSame('submitted', $attempt->fresh()->status);
    }

    public function test_opening_take_page_after_close_grades_and_redirects_to_result(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture(['ends_at' => now()->subMinute()]);
        $attempt = $this->startedAttempt($student, $exam, now()->subMinutes(5), now()->subMinute());

        $this->actingAs($student)->get(route('attempts.take', $attempt))->assertRedirect(route('attempts.result', $attempt));
        $this->assertSame('submitted', $attempt->fresh()->status);
    }

    public function test_show_page_displays_window_state(): void
    {
        $this->freezeSecond();
        [$student, , $upcoming] = $this->examFixture(['starts_at' => now()->addDay()]);
        $open = Exam::create(['course_id' => $upcoming->course_id, 'title' => 'Mở', 'duration_minutes' => 30, 'pass_score' => 50, 'max_attempts' => 1, 'status' => 'published', 'ends_at' => now()->addDay()]);
        $closed = Exam::create(['course_id' => $upcoming->course_id, 'title' => 'Đóng', 'duration_minutes' => 30, 'pass_score' => 50, 'max_attempts' => 1, 'status' => 'published', 'ends_at' => now()->subDay()]);
        $this->actingAs($student);

        $this->get(route('exams.show', $upcoming))->assertOk()->assertSee('Chưa mở – mở lúc')->assertDontSee('Bắt đầu làm bài');
        $this->get(route('exams.show', $open))->assertOk()->assertSee('Đang mở – đóng lúc')->assertSee('Bắt đầu làm bài');
        $this->get(route('exams.show', $closed))->assertOk()->assertSee('Đã đóng')->assertDontSee('Bắt đầu làm bài');
    }

    public function test_closing_time_must_be_after_opening_time(): void
    {
        [, $course, , $instructor] = $this->examFixture();
        $this->actingAs($instructor);

        $this->post(route('instructor.courses.exams.store', $course), $this->validExamPayload(['starts_at' => '2026-12-10T10:00', 'ends_at' => '2026-12-10T09:00']))
            ->assertSessionHasErrors(['ends_at' => 'Thời gian đóng đề phải sau thời gian mở đề.']);

        $this->post(route('instructor.courses.exams.store', $course), $this->validExamPayload(['ends_at' => '2026-12-10T09:00']))
            ->assertSessionHasNoErrors();
    }

    public function test_instructor_can_save_window_and_anti_cheat_settings(): void
    {
        [, $course, , $instructor] = $this->examFixture();
        $this->actingAs($instructor);

        $this->post(route('instructor.courses.exams.store', $course), $this->validExamPayload([
            'title' => 'Có lịch', 'starts_at' => '2026-12-10T08:00', 'ends_at' => '2026-12-10T10:00', 'anti_cheat_enabled' => '1', 'max_violations' => 5,
        ]))->assertSessionHasNoErrors();

        $exam = Exam::where('title', 'Có lịch')->firstOrFail();
        $this->assertSame('2026-12-10 08:00', $exam->starts_at->format('Y-m-d H:i'));
        $this->assertSame('2026-12-10 10:00', $exam->ends_at->format('Y-m-d H:i'));
        $this->assertTrue($exam->anti_cheat_enabled);
        $this->assertSame(5, $exam->max_violations);

        $this->post(route('instructor.courses.exams.store', $course), $this->validExamPayload(['title' => 'Không giám sát']))->assertSessionHasNoErrors();
        $plain = Exam::where('title', 'Không giám sát')->firstOrFail();
        $this->assertFalse($plain->anti_cheat_enabled);
        $this->assertSame(3, $plain->max_violations);
    }

    public function test_shortening_closing_time_clamps_in_progress_attempts(): void
    {
        $this->freezeSecond();
        [$student, $course, $exam, $instructor] = $this->examFixture(['duration_minutes' => 60]);
        $attempt = $this->startedAttempt($student, $exam);
        $expired = $this->startedAttempt($student, $exam, now()->subHours(2), now()->subHour());
        $newEnd = now()->addMinutes(10);

        $this->actingAs($instructor)->put(route('instructor.courses.exams.update', [$course, $exam]), $this->validExamPayload([
            'title' => $exam->title, 'duration_minutes' => 60, 'ends_at' => $newEnd->format('Y-m-d\TH:i:s'),
        ]))->assertSessionHasNoErrors();

        $this->assertSame($newEnd->timestamp, $attempt->fresh()->expires_at->timestamp);
        $this->assertTrue($expired->fresh()->expires_at->lt(now()), 'Expired attempts must not be revived.');
    }

    public function test_results_page_finalizes_abandoned_expired_attempts(): void
    {
        $this->freezeSecond();
        [$student, , $exam, $instructor] = $this->examFixture();
        $attempt = $this->startedAttempt($student, $exam, now()->subHours(2), now()->subHour());

        $this->actingAs($instructor)->get(route('instructor.exams.results', $exam))->assertOk()->assertSee($student->name);

        $this->assertSame('submitted', $attempt->fresh()->status);
        $this->assertNotNull($attempt->fresh()->submitted_at);
    }

    public function test_zero_max_attempts_means_unlimited(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture(['max_attempts' => 0]);
        $this->actingAs($student);

        foreach (range(1, 4) as $n) {
            $this->post(route('exams.start', $exam))->assertRedirect()->assertSessionMissing('error');
            ExamAttempt::where('status', 'in_progress')->first()->update(['status' => 'submitted', 'submitted_at' => now()]);
        }

        $this->assertSame(4, ExamAttempt::count());
        $this->get(route('exams.show', $exam))->assertOk()->assertSee('Không giới hạn');
    }

    public function test_limited_max_attempts_still_blocks(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture(['max_attempts' => 1]);
        $this->startedAttempt($student, $exam)->update(['status' => 'submitted', 'submitted_at' => now()]);

        $this->actingAs($student)->post(route('exams.start', $exam))->assertSessionHas('error', 'Bạn đã sử dụng hết số lần làm bài.');
    }

    public function test_ends_at_without_starts_at_passes_validation(): void
    {
        [, $course, , $instructor] = $this->examFixture();

        $this->actingAs($instructor)->post(route('instructor.courses.exams.store', $course), $this->validExamPayload(['starts_at' => '', 'ends_at' => '2026-12-10T09:00']))
            ->assertSessionHasNoErrors();
    }

    public function test_finalize_expired_grades_all_expired_attempts_at_their_deadline(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture();
        $expiresAt = now()->subHour();
        $attempts = collect(range(1, 3))->map(fn () => $this->startedAttempt($student, $exam, now()->subHours(2), $expiresAt));
        $live = $this->startedAttempt($student, $exam);

        $this->assertSame(3, app(ExamGradingService::class)->finalizeExpired($exam));

        foreach ($attempts as $attempt) {
            $fresh = $attempt->fresh();
            $this->assertSame('submitted', $fresh->status);
            $this->assertSame($expiresAt->timestamp, $fresh->submitted_at->timestamp);
        }
        $this->assertSame('in_progress', $live->fresh()->status);
    }

    public function test_finalize_expired_continues_after_one_attempt_fails(): void
    {
        $this->freezeSecond();
        [$student, , $exam] = $this->examFixture();
        $first = $this->startedAttempt($student, $exam, now()->subHours(2), now()->subHour());
        $second = $this->startedAttempt($student, $exam, now()->subHours(2), now()->subHour());

        $certificates = $this->mock(CertificateService::class);
        $certificates->shouldReceive('issueIfEligible')->once()->andThrow(new \RuntimeException('pdf failed'));
        $certificates->shouldReceive('issueIfEligible')->once();

        $this->assertSame(1, app(ExamGradingService::class)->finalizeExpired($exam));
        $this->assertSame(['submitted', 'submitted'], [$first->fresh()->status, $second->fresh()->status]);
    }

    public function test_extending_closing_time_extends_in_progress_attempt(): void
    {
        $this->freezeSecond();
        [$student, $course, $exam, $instructor] = $this->examFixture(['duration_minutes' => 60, 'ends_at' => now()->addMinutes(10)]);
        $attempt = $this->startedAttempt($student, $exam);
        $this->assertSame(now()->addMinutes(10)->timestamp, $attempt->expires_at->timestamp);

        $this->actingAs($instructor)->put(route('instructor.courses.exams.update', [$course, $exam]), $this->validExamPayload([
            'title' => $exam->title, 'duration_minutes' => 60, 'ends_at' => now()->addMinutes(40)->format('Y-m-d\TH:i:s'),
        ]))->assertSessionHasNoErrors();

        $this->assertSame(now()->addMinutes(40)->timestamp, $attempt->fresh()->expires_at->timestamp);
    }
}
