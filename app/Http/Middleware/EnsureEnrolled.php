<?php

namespace App\Http\Middleware;

use App\Models\Course;
use App\Models\Lesson;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEnrolled
{
    public function handle(Request $request, Closure $next): Response
    {
        $course = $request->route('course');
        $lesson = $request->route('lesson');
        if (is_string($course)) {
            $course = Course::where('slug', $course)->firstOrFail();
        }
        if (is_string($lesson) && ctype_digit($lesson)) {
            $lesson = Lesson::findOrFail($lesson);
        }
        $preview = $lesson instanceof Lesson && $lesson->is_preview
            && $lesson->section()->where('course_id', $course->id)->exists();
        if ($preview) {
            return $next($request);
        }
        abort_unless($request->user(), 403, 'Vui lòng đăng nhập và đăng ký khóa học.');
        abort_unless($request->user()->enrolledCourses()->whereKey($course->id)->wherePivot('status', 'active')->exists(), 403, 'Bạn chưa được phép học khóa học này.');

        return $next($request);
    }
}
