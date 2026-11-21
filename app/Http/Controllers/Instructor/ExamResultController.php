<?php

namespace App\Http\Controllers\Instructor;

use App\Exports\ExamScoresExport;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Services\ExamGradingService;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExamResultController extends Controller
{
    public function index(Exam $exam, ExamGradingService $grading): View
    {
        Gate::authorize('view', $exam);
        $grading->finalizeExpired($exam);
        $base = $exam->attempts()->whereNotNull('submitted_at');
        $stats = ['average' => (float) (clone $base)->avg('score'), 'max' => (float) (clone $base)->max('score'), 'min' => (float) (clone $base)->min('score'), 'flagged' => (clone $base)->whereNotNull('flagged_at')->count(), 'pass_rate' => ($total = (clone $base)->count()) ? round((clone $base)->where('passed', true)->count() * 100 / $total, 2) : 0];
        $attempts = $base->with(['user', 'violations'])->latest('submitted_at')->paginate(20);

        return view('instructor.exams.results', compact('exam', 'attempts', 'stats'));
    }

    public function export(Exam $exam, ExamGradingService $grading): BinaryFileResponse
    {
        Gate::authorize('view', $exam);
        $grading->finalizeExpired($exam);

        return Excel::download(new ExamScoresExport($exam), 'bang-diem-'.$exam->id.'.xlsx');
    }
}
