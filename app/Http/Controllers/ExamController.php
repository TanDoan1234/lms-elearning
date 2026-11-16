<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Services\ExamGradingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ExamController extends Controller
{
    public function show(Exam $exam): View
    {
        $this->authorizeExam($exam);
        $exam->load(['course.instructor'])->loadCount('questions');
        $attempts = $exam->attempts()->where('user_id', auth()->id())->latest('started_at')->get();

        return view('exams.show', compact('exam', 'attempts'));
    }

    public function start(Exam $exam): RedirectResponse
    {
        $this->authorizeExam($exam);

        abort_unless(auth()->user()->isStudent(), 403);

        $unfinished = $exam->attempts()->where('user_id', auth()->id())->where('status', 'in_progress')->latest()->first();
        if ($unfinished) {
            if ($unfinished->expires_at->addSeconds(5)->isPast()) {
                app(ExamGradingService::class)->grade($unfinished);
            } else {
                return redirect()->route('attempts.take', $unfinished);
            }
        }

        $used = $exam->attempts()->where('user_id', auth()->id())->count();
        if ($used >= $exam->max_attempts) {
            return back()->with('error', 'Bạn đã sử dụng hết số lần làm bài.');
        }

        $questionIds = $exam->questions()->pluck('questions.id');
        if ($questionIds->isEmpty()) {
            return back()->with('error', 'Đề thi chưa có câu hỏi nên chưa thể bắt đầu.');
        }
        if ($exam->shuffle_questions) {
            $questionIds = $questionIds->shuffle();
        }

        $attempt = ExamAttempt::create([
            'exam_id' => $exam->id,
            'user_id' => auth()->id(),
            'started_at' => now(),
            'expires_at' => now()->addMinutes($exam->duration_minutes),
            'question_order' => $questionIds->values()->all(),
        ]);

        $attempt->answers()->createMany($questionIds->map(fn ($id) => ['question_id' => $id, 'selected_option_ids' => []])->all());

        return redirect()->route('attempts.take', $attempt);
    }

    private function authorizeExam(Exam $exam): void
    {
        abort_unless($exam->status === 'published', 404);
        $user = auth()->user();
        $allowed = $user->isAdmin()
            || ($user->isInstructor() && $exam->course()->where('instructor_id', $user->id)->exists())
            || ($user->isStudent() && $exam->course->students()->where('users.id', $user->id)->wherePivot('status', 'active')->exists());

        abort_unless($allowed, 403);
    }
}
