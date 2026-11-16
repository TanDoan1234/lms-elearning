<?php

namespace App\Http\Controllers;

use App\Models\ExamAttempt;
use App\Services\ExamGradingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class AttemptController extends Controller
{
    public function take(ExamAttempt $attempt, ExamGradingService $grading): View|RedirectResponse
    {
        Gate::authorize('update', $attempt);

        if ($attempt->expires_at->addSeconds(5)->isPast()) {
            $grading->grade($attempt);

            return redirect()->route('attempts.result', $attempt)->with('error', 'Thời gian làm bài đã hết.');
        }

        return view('attempts.take', compact('attempt'));
    }

    public function result(ExamAttempt $attempt, ExamGradingService $grading): View
    {
        Gate::authorize('view', $attempt);
        if ($attempt->status === 'in_progress' && $attempt->expires_at->addSeconds(5)->isPast()) {
            $attempt = $grading->grade($attempt);
        }
        abort_if($attempt->status === 'in_progress', 404);

        $attempt->load(['exam.course', 'exam.questions.options', 'answers']);

        return view('attempts.result', compact('attempt'));
    }

    public function index(): View
    {
        $attempts = auth()->user()->examAttempts()->with('exam.course')->latest('started_at')->paginate(12);

        return view('attempts.index', compact('attempts'));
    }
}
