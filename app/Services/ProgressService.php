<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;

class ProgressService
{
    public function complete(User $user, Lesson $lesson): int
    {
        $user->completedLessons()->syncWithoutDetaching([$lesson->id => ['completed_at' => now()]]);
        $course = $lesson->section->course;
        $percent = $this->percent($user, $course);
        if ($percent === 100) {
            $user->enrolledCourses()->updateExistingPivot($course->id, ['completed_at' => now()]);
        }

        return $percent;
    }

    public function percent(User $user, Course $course): int
    {
        $lessonIds = $course->lessons()->pluck('lessons.id');
        if ($lessonIds->isEmpty()) {
            return 0;
        }

        return (int) round($user->completedLessons()->whereIn('lessons.id', $lessonIds)->count() * 100 / $lessonIds->count());
    }

    public function isCourseCompleted(User $user, Course $course): bool
    {
        return $this->percent($user, $course) === 100;
    }

    public function nextLesson(User $user, Course $course): ?Lesson
    {
        $completedIds = $user->completedLessons()
            ->whereIn('lessons.id', $course->lessons()->pluck('lessons.id'))
            ->pluck('lessons.id');

        return $course->sections()
            ->with('lessons')
            ->get()
            ->flatMap->lessons
            ->first(fn (Lesson $lesson) => ! $completedIds->contains($lesson->id));
    }
}
