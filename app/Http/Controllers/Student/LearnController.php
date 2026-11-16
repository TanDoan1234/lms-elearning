<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Services\CertificateService;
use App\Services\ProgressService;
use Illuminate\Http\JsonResponse;

class LearnController extends Controller
{
    public function show(Course $course, ?Lesson $lesson, ProgressService $progress)
    {
        $course->load('sections.lessons');
        $lessons = $course->sections->flatMap->lessons->values();
        $lesson ??= $lessons->first();
        abort_unless($lesson && $lesson->section->course_id === $course->id, 404);
        $completedIds = auth()->check() ? auth()->user()->completedLessons()->whereIn('lessons.id', $lessons->pluck('id'))->pluck('lessons.id') : collect();
        $percent = auth()->check() ? $progress->percent(auth()->user(), $course) : 0;
        $index = $lessons->search(fn ($item) => $item->is($lesson));
        $previous = $index > 0 ? $lessons[$index - 1] : null;
        $next = $index !== false && $index < $lessons->count() - 1 ? $lessons[$index + 1] : null;
        $nextPending = auth()->check() ? $progress->nextLesson(auth()->user(), $course) : null;

        return view('learn.show', compact('course', 'lesson', 'lessons', 'completedIds', 'percent', 'previous', 'next', 'nextPending'));
    }

    public function complete(Lesson $lesson, ProgressService $progress, CertificateService $certificates): JsonResponse
    {
        $course = $lesson->section->course;
        abort_unless(request()->user()->enrolledCourses()->whereKey($course->id)->wherePivot('status', 'active')->exists(), 403);
        $percent = $progress->complete(request()->user(), $lesson);
        $certificate = $percent === 100
            ? $certificates->issueIfEligible(request()->user(), $course)
            : null;

        return response()->json([
            'completed' => true,
            'progress' => $percent,
            'course_completed' => $percent === 100,
            'certificate_url' => $certificate ? route('certificates.download', $certificate) : null,
        ]);
    }
}
