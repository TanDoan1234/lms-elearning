<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;

class CourseCatalogController extends Controller
{
    public function index()
    {
        return view('courses.index');
    }

    public function show(Course $course)
    {
        abort_unless($course->status === 'published', 404);
        $course->load(['category', 'instructor', 'sections.lessons'])->loadCount('students');
        $enrollment = auth()->check() ? auth()->user()->enrolledCourses()->whereKey($course->id)->first()?->pivot : null;
        $pendingOrder = auth()->check() ? auth()->user()->orders()->where('course_id', $course->id)->where('status', 'pending')->latest()->first() : null;

        return view('courses.show', compact('course', 'enrollment', 'pendingOrder'));
    }
}
