<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'description', 'duration_minutes', 'pass_score', 'max_attempts', 'shuffle_questions', 'is_final', 'status', 'starts_at', 'ends_at', 'anti_cheat_enabled', 'max_violations'];

    public const WINDOW_UPCOMING = 'upcoming';

    public const WINDOW_OPEN = 'open';

    public const WINDOW_CLOSED = 'closed';

    protected function casts(): array
    {
        return ['duration_minutes' => 'integer', 'pass_score' => 'decimal:2', 'max_attempts' => 'integer', 'shuffle_questions' => 'boolean', 'is_final' => 'boolean', 'starts_at' => 'datetime', 'ends_at' => 'datetime', 'anti_cheat_enabled' => 'boolean', 'max_violations' => 'integer'];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class)->withPivot('points', 'position')->orderByPivot('position');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(ExamAttempt::class);
    }

    /** max_attempts = 0 means unlimited. */
    public function hasUnlimitedAttempts(): bool
    {
        return (int) $this->max_attempts === 0;
    }

    public function attemptsRemaining(int $used): ?int
    {
        return $this->hasUnlimitedAttempts() ? null : max(0, (int) $this->max_attempts - $used);
    }

    public function windowState(?CarbonInterface $now = null): string
    {
        $now ??= now();

        if ($this->starts_at && $now->lt($this->starts_at)) {
            return self::WINDOW_UPCOMING;
        }
        if ($this->ends_at && $now->gte($this->ends_at)) {
            return self::WINDOW_CLOSED;
        }

        return self::WINDOW_OPEN;
    }

    public function isOpenForAttempts(?CarbonInterface $now = null): bool
    {
        return $this->windowState($now) === self::WINDOW_OPEN;
    }

    /** The attempt deadline: started_at + duration, capped by the closing time. */
    public function deadlineFor(CarbonInterface $startedAt): CarbonInterface
    {
        $deadline = $startedAt->copy()->addMinutes($this->duration_minutes);

        return $this->ends_at && $this->ends_at->lt($deadline) ? $this->ends_at->copy() : $deadline;
    }

    /** Re-computes deadlines of in-progress attempts that have not yet expired. */
    public function syncInProgressDeadlines(): int
    {
        $count = 0;
        $attempts = $this->attempts()->where('status', 'in_progress')->get();

        foreach ($attempts as $attempt) {
            if ($attempt->isPastDeadline()) {
                continue;
            }
            $attempt->update(['expires_at' => $this->deadlineFor($attempt->started_at)]);
            $count++;
        }

        return $count;
    }
}
