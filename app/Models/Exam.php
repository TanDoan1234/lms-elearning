<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'description', 'duration_minutes', 'pass_score', 'max_attempts', 'shuffle_questions', 'is_final', 'status'];

    protected function casts(): array
    {
        return ['duration_minutes' => 'integer', 'pass_score' => 'decimal:2', 'max_attempts' => 'integer', 'shuffle_questions' => 'boolean', 'is_final' => 'boolean'];
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
}
