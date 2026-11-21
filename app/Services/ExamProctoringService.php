<?php

namespace App\Services;

use App\Models\ExamAttempt;
use App\Models\ExamAttemptViolation;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ExamProctoringService
{
    /** Violations reported closer together than this are counted once (tab switch fires several events). */
    public const DEBOUNCE_SECONDS = 3;

    public function __construct(private readonly ExamGradingService $grading) {}

    /**
     * @return array{recorded: bool, count: int, max: int, remaining: int, submitted: bool}
     */
    public function record(ExamAttempt $attempt, User $user, string $type): array
    {
        if ($attempt->user_id !== $user->id || ! in_array($type, ExamAttemptViolation::TYPES, true)) {
            return $this->state($attempt, false);
        }

        $exceeded = false;
        $recorded = false;

        $locked = DB::transaction(function () use ($attempt, $type, &$exceeded, &$recorded) {
            $locked = ExamAttempt::query()->with('exam')->lockForUpdate()->findOrFail($attempt->id);

            if ($locked->status !== 'in_progress' || ! $locked->exam->anti_cheat_enabled || $locked->isPastDeadline()) {
                return $locked;
            }

            $last = $locked->violations()->reorder('occurred_at', 'desc')->value('occurred_at');
            if ($last && now()->diffInSeconds(\Carbon\Carbon::parse($last), true) < self::DEBOUNCE_SECONDS) {
                return $locked;
            }

            $locked->violations()->create(['type' => $type, 'occurred_at' => now()]);
            $locked->violation_count = (int) $locked->violation_count + 1;
            $exceeded = $locked->violation_count > (int) $locked->exam->max_violations;
            if ($exceeded) {
                $locked->flagged_at = now();
            }
            $locked->save();
            $recorded = true;

            return $locked;
        });

        if ($exceeded) {
            $locked = $this->grading->grade($locked);
        }

        return $this->state($locked, $recorded);
    }

    private function state(ExamAttempt $attempt, bool $recorded): array
    {
        $attempt->loadMissing('exam');
        $count = (int) $attempt->violation_count;
        $max = (int) $attempt->exam->max_violations;

        return [
            'recorded' => $recorded,
            'count' => $count,
            'max' => $max,
            'remaining' => max(0, $max - $count),
            'submitted' => $attempt->status !== 'in_progress',
        ];
    }
}
