<?php

namespace App\Services;

use App\Models\ExamAttempt;
use Illuminate\Support\Facades\DB;

class ExamGradingService
{
    public function __construct(private readonly CertificateService $certificates) {}

    public function grade(ExamAttempt $attempt): ExamAttempt
    {
        if ($attempt->status !== 'in_progress') {
            return $attempt->fresh();
        }

        $graded = DB::transaction(function () use ($attempt) {
            $locked = ExamAttempt::query()->lockForUpdate()->findOrFail($attempt->id);

            if ($locked->status !== 'in_progress') {
                return $locked;
            }

            $locked->load(['exam.questions.options', 'answers']);
            $answers = $locked->answers->keyBy('question_id');
            $earned = 0.0;
            $available = 0.0;
            $correctCount = 0;

            foreach ($locked->exam->questions as $question) {
                $points = (float) $question->pivot->points;
                $available += $points;
                $correct = $question->options->where('is_correct', true)->pluck('id')->map(fn ($id) => (int) $id)->sort()->values()->all();
                $selected = collect($answers->get($question->id)?->selected_option_ids ?? [])->map(fn ($id) => (int) $id)->unique()->sort()->values()->all();
                $isCorrect = $selected === $correct;

                if ($answer = $answers->get($question->id)) {
                    $answer->update(['is_correct' => $isCorrect]);
                }

                if ($isCorrect) {
                    $earned += $points;
                    $correctCount++;
                }
            }

            $score = $available > 0 ? round(($earned / $available) * 100, 2) : 0.0;
            $locked->update([
                'score' => $score,
                'correct_count' => $correctCount,
                'total' => $locked->exam->questions->count(),
                'passed' => $score >= (float) $locked->exam->pass_score,
                'submitted_at' => now(),
                'status' => 'submitted',
            ]);

            return $locked->fresh(['exam.course', 'user']);
        });

        $this->certificates->issueIfEligible($graded->user, $graded->exam->course);

        return $graded;
    }
}
