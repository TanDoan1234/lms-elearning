<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Services\ActivityHeatmapService;
use App\Support\MonthlySeries;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(ActivityHeatmapService $heatmap)
    {
        $user = request()->user();
        $q = Course::query()->when(! $user->isAdmin(), fn ($q) => $q->where('instructor_id', $user->id));
        $courses = (clone $q)->with('category')
            ->withCount(['students as active_students_count' => fn ($q) => $q->where('course_user.status', 'active'), 'lessons', 'exams'])
            ->orderByDesc('active_students_count')->get();
        $courseIds = $courses->pluck('id');

        $attempts = ExamAttempt::where('status', 'submitted')->whereHas('exam', fn ($q) => $q->whereIn('course_id', $courseIds));
        $attemptCount = (clone $attempts)->count();
        $stats = [
            'courses' => $courses->count(),
            'students' => $courses->sum('active_students_count'),
            'attempts' => $attemptCount,
            'pass_rate' => $attemptCount ? round((clone $attempts)->where('passed', true)->count() * 100 / $attemptCount, 1) : 0,
            'avg_score' => $attemptCount ? round((float) (clone $attempts)->avg('score'), 1) : 0,
        ];

        $enrollmentsByMonth = MonthlySeries::sum(DB::table('course_user')->whereIn('course_id', $courseIds)
            ->where('enrolled_at', '>=', MonthlySeries::start())->pluck('enrolled_at')->map(fn ($d) => [$d, 1]));

        $recentEnrollments = DB::table('course_user')
            ->join('users', 'users.id', '=', 'course_user.user_id')
            ->join('courses', 'courses.id', '=', 'course_user.course_id')
            ->whereIn('course_user.course_id', $courseIds)->whereNotNull('course_user.enrolled_at')
            ->orderByDesc('course_user.enrolled_at')->limit(8)
            ->get(['users.name as student_name', 'courses.title as course_title', 'course_user.enrolled_at', 'course_user.status']);

        $needsAttention = [
            'draft_courses' => $courses->where('status', 'draft')->count(),
            'empty_exams' => Exam::whereIn('course_id', $courseIds)->withCount('questions')->get()->where('questions_count', 0)->count(),
            'draft_exams' => Exam::whereIn('course_id', $courseIds)->where('status', 'draft')->count(),
        ];
        $activityDays = $heatmap->build(
            DB::table('lesson_user')->join('lessons', 'lessons.id', '=', 'lesson_user.lesson_id')->join('sections', 'sections.id', '=', 'lessons.section_id')->whereIn('sections.course_id', $courseIds)->whereNotNull('lesson_user.completed_at')->pluck('lesson_user.completed_at'),
            ExamAttempt::whereHas('exam', fn ($query) => $query->whereIn('course_id', $courseIds))->whereNotNull('submitted_at')->pluck('submitted_at')
        );

        return view('instructor.dashboard.index', compact('courses', 'stats', 'enrollmentsByMonth', 'recentEnrollments', 'needsAttention', 'activityDays'));
    }
}
