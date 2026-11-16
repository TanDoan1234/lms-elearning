<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['instructor_id', 'category_id', 'title', 'slug', 'short_description', 'description', 'thumbnail', 'price', 'level', 'status'];

    protected $appends = ['is_free'];

    protected function casts(): array
    {
        return ['price' => 'decimal:0'];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('position');
    }

    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('status', 'price_paid', 'enrolled_at', 'completed_at')->withTimestamps();
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function finalExam(): HasOne
    {
        return $this->hasOne(Exam::class)->where('is_final', true);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function scopePublished(Builder $q): Builder
    {
        return $q->where('status', 'published');
    }

    public function scopeFree(Builder $q): Builder
    {
        return $q->where('price', 0);
    }

    public function scopePaid(Builder $q): Builder
    {
        return $q->where('price', '>', 0);
    }

    public function getIsFreeAttribute(): bool
    {
        return (float) $this->price === 0.0;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
