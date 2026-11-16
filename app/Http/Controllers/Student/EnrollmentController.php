<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\EnrollmentService;
use Illuminate\Http\RedirectResponse;

class EnrollmentController extends Controller
{
    public function __invoke(Course $course, EnrollmentService $service): RedirectResponse
    {
        abort_unless($course->status === 'published', 404);
        $existing = request()->user()->enrolledCourses()->whereKey($course->id)->first();
        if ($existing?->pivot->status === 'active') {
            return redirect()->route('learn.show', $course)->with('success', 'Bạn đã đăng ký khóa học này.');
        }
        $order = $service->enroll(request()->user(), $course);
        if ($order) {
            return redirect()->route('checkout.show', $course)->with('success', 'Đơn hàng đã được tạo.');
        }

        return redirect()->route('learn.show', $course)->with('success', 'Đăng ký khóa học thành công.');
    }
}
