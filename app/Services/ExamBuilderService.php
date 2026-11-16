<?php

namespace App\Services;

use App\Models\Exam;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ExamBuilderService
{
    public function random(Exam $exam, array $counts): void
    {
        $questions = collect();
        foreach (['easy', 'medium', 'hard'] as $difficulty) {
            $count = max(0, (int) ($counts[$difficulty] ?? 0));
            $available = $exam->course->questions()->where('difficulty', $difficulty)->inRandomOrder()->limit($count)->get();
            if ($available->count() !== $count) {
                throw ValidationException::withMessages(['random.'.$difficulty => "Không đủ câu hỏi mức {$difficulty} (cần {$count}, hiện có {$available->count()})."]);
            }
            $questions = $questions->concat($available);
        }
        if ($questions->isEmpty()) {
            throw ValidationException::withMessages(['random' => 'Phải chọn ít nhất một câu hỏi.']);
        }
        DB::transaction(function () use ($exam, $questions) {
            $sync = $questions->values()->mapWithKeys(fn ($question, $position) => [$question->id => ['points' => 1, 'position' => $position + 1]])->all();
            $exam->questions()->sync($sync);
        });
    }

    public function manual(Exam $exam, array $rows): void
    {
        $allowed = $exam->course->questions()->pluck('id')->all();
        $sync = [];
        foreach ($rows as $id => $row) {
            if (! empty($row['selected']) && in_array((int) $id, $allowed, true)) {
                $sync[(int) $id] = ['points' => (float) ($row['points'] ?? 1), 'position' => count($sync) + 1];
            }
        }
        if ($sync === []) {
            throw ValidationException::withMessages(['questions' => 'Phải chọn ít nhất một câu hỏi.']);
        }
        $exam->questions()->sync($sync);
    }
}
