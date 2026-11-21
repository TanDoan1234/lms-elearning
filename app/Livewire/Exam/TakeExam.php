<?php

namespace App\Livewire\Exam;

use App\Models\ExamAttempt;
use App\Models\Question;
use App\Services\ExamGradingService;
use App\Services\ExamProctoringService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class TakeExam extends Component
{
    public ExamAttempt $attempt;

    public int $currentIndex = 0;

    public array $selected = [];

    public array $flagged = [];

    public function mount(ExamAttempt $attempt): void
    {
        Gate::authorize('update', $attempt);
        $this->attempt = $attempt;
        $this->finalizeIfExpired();
        $this->loadSelection();
    }

    public function goTo(int $index): void
    {
        $this->currentIndex = max(0, min($index, count($this->questionIds()) - 1));
        $this->loadSelection();
    }

    public function next(): void
    {
        $this->goTo($this->currentIndex + 1);
    }

    public function previous(): void
    {
        $this->goTo($this->currentIndex - 1);
    }

    public function toggleFlag(): void
    {
        $id = $this->currentQuestionId();
        $this->flagged[$id] = ! ($this->flagged[$id] ?? false);
    }

    public function selectOption(int $optionId): void
    {
        $this->assertWritable();
        $question = $this->currentQuestion();
        abort_unless($question->options->contains('id', $optionId), 422);

        if ($question->type === 'single') {
            $this->selected = [$optionId];
        } elseif (in_array($optionId, $this->selected, true)) {
            $this->selected = array_values(array_diff($this->selected, [$optionId]));
        } else {
            $this->selected[] = $optionId;
        }

        $this->attempt->answers()->where('question_id', $question->id)->update([
            'selected_option_ids' => array_values(array_unique(array_map('intval', $this->selected))),
        ]);
        $this->attempt->unsetRelation('answers');
    }

    public function submit(ExamGradingService $grading): void
    {
        Gate::authorize('update', $this->attempt);
        $grading->grade($this->attempt);
        $this->redirectRoute('attempts.result', $this->attempt, navigate: true);
    }

    /** Records an anti-cheat violation reported by the browser. */
    public function logViolation(string $type): array
    {
        abort_unless($this->attempt->user_id === auth()->id(), 403);

        $this->attempt->refresh();
        if ($this->attempt->status !== 'in_progress' || $this->attempt->isPastDeadline()) {
            if ($this->attempt->status === 'in_progress') {
                app(ExamGradingService::class)->grade($this->attempt);
                $this->attempt->refresh();
            }
            $this->redirectRoute('attempts.result', $this->attempt, navigate: true);

            return ['recorded' => false, 'submitted' => true];
        }

        $result = app(ExamProctoringService::class)->record($this->attempt, auth()->user(), $type);
        $this->attempt->refresh();

        if ($result['submitted']) {
            $this->redirectRoute('attempts.result', $this->attempt, navigate: true);
        }

        return $result;
    }

    public function checkExpiry(): void
    {
        $this->finalizeIfExpired();
    }

    public function render()
    {
        $this->attempt->loadMissing(['exam.questions.options', 'answers']);
        $questions = collect($this->questionIds())->map(fn ($id) => $this->attempt->exam->questions->firstWhere('id', $id))->filter()->values();
        $question = $questions->get($this->currentIndex);
        $answeredIds = $this->attempt->answers->filter(fn ($answer) => count($answer->selected_option_ids ?? []) > 0)->pluck('question_id')->all();
        $unansweredCount = max(0, $questions->count() - count($answeredIds));

        return view('livewire.exam.take-exam', compact('questions', 'question', 'answeredIds', 'unansweredCount'));
    }

    private function loadSelection(): void
    {
        $this->selected = array_map('intval', $this->attempt->answers()->where('question_id', $this->currentQuestionId())->value('selected_option_ids') ?? []);
    }

    private function currentQuestion(): Question
    {
        $this->attempt->loadMissing('exam.questions.options');

        return $this->attempt->exam->questions->firstWhere('id', $this->currentQuestionId()) ?? abort(404);
    }

    private function currentQuestionId(): int
    {
        return (int) ($this->questionIds()[$this->currentIndex] ?? abort(404));
    }

    private function questionIds(): array
    {
        return $this->attempt->question_order ?: $this->attempt->exam()->firstOrFail()->questions()->pluck('questions.id')->all();
    }

    private function assertWritable(): void
    {
        Gate::authorize('update', $this->attempt);
        if ($this->attempt->isPastDeadline()) {
            app(ExamGradingService::class)->grade($this->attempt);
            abort(409, 'Thời gian làm bài đã hết.');
        }
    }

    private function finalizeIfExpired(): void
    {
        if ($this->attempt->status === 'in_progress' && $this->attempt->isPastDeadline()) {
            app(ExamGradingService::class)->grade($this->attempt);
            $this->redirectRoute('attempts.result', $this->attempt, navigate: true);
        }
    }
}
