<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function index()
    {
        Gate::authorize('viewAny', Course::class);
        $courses = Course::with(['instructor', 'category'])->withCount('students')->latest()->paginate(15);

        return view('admin.courses.index', compact('courses'));
    }

    public function toggleStatus(Course $course)
    {
        Gate::authorize('update', $course);
        $course->update(['status' => $course->status === 'published' ? 'draft' : 'published']);

        return back()->with('success', 'Đã cập nhật trạng thái khóa học.');
    }
}
