<?php

namespace App\Exports;

use App\Models\Course;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuestionsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    public function __construct(private readonly Course $course) {}

    public function collection(): Enumerable
    {
        return $this->course->questions()->with('options')->get();
    }

    public function headings(): array
    {
        return (new QuestionTemplateExport)->headings();
    }

    public function map($question): array
    {
        $options = $question->options->values();
        $correct = $options->map(fn ($option, $i) => $option->is_correct ? chr(65 + $i) : null)->filter()->implode(',');

        return [$question->content, $question->type, $question->difficulty, ...collect(range(0, 5))->map(fn ($i) => $options->get($i)?->content ?? '')->all(), $correct, $question->explanation];
    }
}
