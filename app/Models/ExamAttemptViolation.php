<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamAttemptViolation extends Model
{
    public const TYPES = ['tab_hidden', 'window_blur'];

    public const LABELS = [
        'tab_hidden' => 'Chuyển tab / thu nhỏ trình duyệt',
        'window_blur' => 'Rời khỏi cửa sổ làm bài',
    ];

    public $timestamps = false;

    protected $fillable = ['exam_attempt_id', 'type', 'occurred_at'];

    protected function casts(): array
    {
        return ['occurred_at' => 'datetime'];
    }

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(ExamAttempt::class, 'exam_attempt_id');
    }
}
