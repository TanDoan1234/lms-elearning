<?php

namespace Tests\Feature\Exams;

use App\Exports\ExamScoresExport;
use App\Livewire\Exam\TakeExam;
use App\Models\Exam;
use App\Models\ExamAttemptViolation;
use App\Models\User;
use App\Services\ExamProctoringService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Concerns\ExamFixtures;
use Tests\TestCase;

class AntiCheatTest extends TestCase
{
    use ExamFixtures, RefreshDatabase;

    private function setup3(array $examOverrides = []): array
    {
        $this->freezeSecond();
        [$student, $course, $exam, $instructor] = $this->examFixture(array_merge(['anti_cheat_enabled' => true, 'max_violations' => 3], $examOverrides));
        $attempt = $this->startedAttempt($student, $exam);
        $this->actingAs($student);

        return [$student, $exam, $attempt, $instructor];
    }

    public function test_violation_is_recorded_and_state_returned(): void
    {
        [, , $attempt] = $this->setup3();

        Livewire::test(TakeExam::class, ['attempt' => $attempt])
            ->call('logViolation', 'tab_hidden')
            ->assertReturned(fn ($result) => $result['recorded'] === true && $result['count'] === 1 && $result['max'] === 3 && $result['remaining'] === 2 && $result['submitted'] === false);

        $this->assertSame(1, $attempt->fresh()->violation_count);
        $this->assertSame(1, $attempt->violations()->count());
    }

    public function test_burst_of_events_counts_once_and_again_after_debounce(): void
    {
        [, , $attempt] = $this->setup3();
        $component = Livewire::test(TakeExam::class, ['attempt' => $attempt]);

        $component->call('logViolation', 'tab_hidden')->call('logViolation', 'window_blur');
        $this->assertSame(1, $attempt->fresh()->violation_count);

        $this->travel(4)->seconds();
        $component->call('logViolation', 'window_blur');
        $this->assertSame(2, $attempt->fresh()->violation_count);
    }

    public function test_exceeding_limit_auto_submits_flags_and_redirects(): void
    {
        [, , $attempt] = $this->setup3(['max_violations' => 1]);
        $component = Livewire::test(TakeExam::class, ['attempt' => $attempt]);

        $component->call('logViolation', 'tab_hidden');
        $this->assertSame('in_progress', $attempt->fresh()->status);

        $this->travel(5)->seconds();
        $component->call('logViolation', 'tab_hidden')->assertRedirect(route('attempts.result', $attempt));

        $fresh = $attempt->fresh();
        $this->assertSame('submitted', $fresh->status);
        $this->assertNotNull($fresh->flagged_at);
        $this->assertSame(2, $fresh->violation_count);
        $this->assertNotNull($fresh->score, 'Flagged attempts are graded normally.');
    }

    public function test_zero_tolerance_submits_on_first_violation(): void
    {
        [, , $attempt] = $this->setup3(['max_violations' => 0]);

        Livewire::test(TakeExam::class, ['attempt' => $attempt])->call('logViolation', 'tab_hidden')->assertRedirect(route('attempts.result', $attempt));

        $this->assertSame('submitted', $attempt->fresh()->status);
        $this->assertTrue($attempt->fresh()->isFlagged());
    }

    public function test_violation_after_deadline_grades_attempt_and_records_nothing(): void
    {
        [, , $attempt] = $this->setup3();
        $component = Livewire::test(TakeExam::class, ['attempt' => $attempt]);

        $this->travel(31)->minutes();
        $component->call('logViolation', 'tab_hidden')->assertRedirect(route('attempts.result', $attempt));

        $this->assertSame('submitted', $attempt->fresh()->status);
        $this->assertSame(0, ExamAttemptViolation::count());
        $this->assertSame($attempt->expires_at->timestamp, $attempt->fresh()->submitted_at->timestamp);
    }

    public function test_violations_are_ignored_when_anti_cheat_disabled(): void
    {
        [, , $attempt] = $this->setup3(['anti_cheat_enabled' => false]);

        Livewire::test(TakeExam::class, ['attempt' => $attempt])
            ->call('logViolation', 'tab_hidden')
            ->assertReturned(fn ($result) => $result['recorded'] === false);

        $this->assertSame(0, $attempt->fresh()->violation_count);
    }

    public function test_submitted_attempts_and_unknown_types_are_ignored(): void
    {
        [$student, , $attempt] = $this->setup3();
        $service = app(ExamProctoringService::class);

        $this->assertFalse($service->record($attempt, $student, 'unknown')['recorded']);
        $this->assertSame(0, ExamAttemptViolation::count());

        $attempt->update(['status' => 'submitted', 'submitted_at' => now()]);
        $this->assertFalse($service->record($attempt->fresh(), $student, 'tab_hidden')['recorded']);
        $this->assertSame(0, ExamAttemptViolation::count());
    }

    public function test_other_user_cannot_record_violations(): void
    {
        [, , $attempt] = $this->setup3();
        $other = User::factory()->create(['role' => 'student']);

        $result = app(ExamProctoringService::class)->record($attempt, $other, 'tab_hidden');

        $this->assertFalse($result['recorded']);
        $this->assertSame(0, ExamAttemptViolation::count());
    }

    public function test_results_page_and_export_show_violations(): void
    {
        [$student, $exam, $attempt, $instructor] = $this->setup3(['max_violations' => 0]);
        Livewire::test(TakeExam::class, ['attempt' => $attempt])->call('logViolation', 'tab_hidden');

        $this->actingAs($instructor)->get(route('instructor.exams.results', $exam))
            ->assertOk()->assertSee('Nộp tự động (vi phạm)')->assertSee('Lượt bị gắn cờ')->assertSee(ExamAttemptViolation::LABELS['tab_hidden']);

        $export = new ExamScoresExport($exam);
        $this->assertSame(['Số lần vi phạm', 'Gắn cờ', 'Thời điểm vi phạm'], array_slice($export->headings(), -3));
        $row = $export->map($attempt->fresh()->load(['user', 'violations']));
        $this->assertSame(1, $row[8]);
        $this->assertSame('Có', $row[9]);
        $this->assertStringContainsString(ExamAttemptViolation::LABELS['tab_hidden'], $row[10]);
    }

    public function test_take_page_shows_proctoring_banner_only_when_enabled(): void
    {
        [$student, $exam, $attempt] = $this->setup3();
        $this->get(route('attempts.take', $attempt))->assertOk()->assertSee('Giám sát thi');

        $plainExam = Exam::create(['course_id' => $exam->course_id, 'title' => 'Không giám sát', 'duration_minutes' => 30, 'pass_score' => 50, 'max_attempts' => 1, 'status' => 'published', 'anti_cheat_enabled' => false]);
        $plainExam->questions()->attach($exam->questions->first()->id, ['points' => 1, 'position' => 1]);
        $plain = $this->startedAttempt($student, $plainExam);
        $this->get(route('attempts.take', $plain))->assertOk()->assertDontSee('Giám sát thi');
    }
}
