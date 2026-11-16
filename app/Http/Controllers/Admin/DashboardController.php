<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\ExamAttempt;
use App\Models\Order;
use App\Models\User;
use App\Services\ActivityHeatmapService;
use App\Support\MonthlySeries;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function __invoke(ActivityHeatmapService $heatmap)
    {
        Gate::authorize('admin');
        $submitted = ExamAttempt::where('status', 'submitted');
        $stats = [
            'students' => User::where('role', 'student')->count(),
            'instructors' => User::where('role', 'instructor')->count(),
            'courses' => Course::count(),
            'enrollments' => DB::table('course_user')->where('status', 'active')->count(),
            'revenue' => Order::where('status', 'paid')->sum('amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'certificates' => Certificate::count(),
            'pass_rate' => ($n = (clone $submitted)->count()) ? round((clone $submitted)->where('passed', true)->count() * 100 / $n, 1) : 0,
        ];

        $start = MonthlySeries::start();
        $enrollmentsByMonth = MonthlySeries::sum(DB::table('course_user')->where('enrolled_at', '>=', $start)->pluck('enrolled_at')->map(fn ($d) => [$d, 1]));
        $revenueByMonth = MonthlySeries::sum(Order::where('status', 'paid')->where('paid_at', '>=', $start)->get(['paid_at', 'amount'])->map(fn ($o) => [$o->paid_at, $o->amount]));

        $topCourses = Course::with(['instructor', 'category'])
            ->withCount(['students as active_students_count' => fn ($q) => $q->where('course_user.status', 'active')])
            ->withSum(['orders as revenue' => fn ($q) => $q->where('status', 'paid')], 'amount')
            ->orderByDesc('active_students_count')->limit(6)->get();
        $latestOrders = Order::with(['user', 'course'])->latest()->limit(6)->get();
        $needsAttention = [
            'pending_orders' => $stats['pending_orders'],
            'draft_courses' => Course::where('status', 'draft')->count(),
        ];
        $activityDays = $heatmap->build(
            DB::table('lesson_user')->whereNotNull('completed_at')->pluck('completed_at'),
            ExamAttempt::whereNotNull('submitted_at')->pluck('submitted_at')
        );

        return view('admin.dashboard.index', compact('stats', 'enrollmentsByMonth', 'revenueByMonth', 'topCourses', 'latestOrders', 'needsAttention', 'activityDays'));
    }
}
