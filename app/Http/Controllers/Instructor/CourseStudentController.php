<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

class CourseStudentController extends Controller
{
    public function __invoke(Course $course)
    {
        Gate::authorize('view', $course);
        $total = $course->lessons()->count();
        $students = $course->students()->wherePivot('status', 'active')->withCount(['completedLessons as completed_lessons_count' => fn ($q) => $q->whereHas('section', fn ($s) => $s->where('course_id', $course->id))])->paginate(20);
        $students->getCollection()->each(fn ($s) => $s->progress = $total ? round($s->completed_lessons_count * 100 / $total) : 0);

        return view('instructor.courses.students', compact('course', 'students', 'total'));
    }
}
