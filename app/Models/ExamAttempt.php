<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = ['exam_id', 'user_id', 'started_at', 'expires_at', 'submitted_at', 'score', 'correct_count', 'total', 'passed', 'status', 'question_order', 'violation_count', 'flagged_at'];

    public const GRACE_SECONDS = 5;

    protected function casts(): array
    {
        return ['started_at' => 'datetime', 'expires_at' => 'datetime', 'submitted_at' => 'datetime', 'score' => 'decimal:2', 'correct_count' => 'integer', 'total' => 'integer', 'passed' => 'boolean', 'question_order' => 'array', 'violation_count' => 'integer', 'flagged_at' => 'datetime'];
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(AttemptAnswer::class);
    }

    public function violations(): HasMany
    {
        return $this->hasMany(ExamAttemptViolation::class)->orderBy('occurred_at');
    }

    public function isPastDeadline(?CarbonInterface $now = null): bool
    {
        return ($now ?? now())->gt($this->expires_at->copy()->addSeconds(self::GRACE_SECONDS));
    }

    public function isFlagged(): bool
    {
        return $this->flagged_at !== null;
    }
}
