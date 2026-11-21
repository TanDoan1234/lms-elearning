<?php

namespace App\Exports;

use App\Models\Exam;
use App\Models\ExamAttemptViolation;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExamScoresExport implements FromQuery, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    private int $number = 0;

    private array $attemptsByUser = [];

    public function __construct(private readonly Exam $exam) {}

    public function query(): Builder
    {
        return $this->exam->attempts()->with(['user', 'violations'])->whereNotNull('submitted_at')->oldest('submitted_at')->getQuery();
    }

    public function headings(): array
    {
        return ['STT', 'Họ tên', 'Email', 'Lần thi', 'Điểm', 'Số câu đúng', 'Kết quả', 'Thời gian nộp', 'Số lần vi phạm', 'Gắn cờ', 'Thời điểm vi phạm'];
    }

    public function map($attempt): array
    {
        $attemptNumber = $this->attemptsByUser[$attempt->user_id] = ($this->attemptsByUser[$attempt->user_id] ?? 0) + 1;

        return [++$this->number, $attempt->user->name, $attempt->user->email, $attemptNumber, $attempt->score, $attempt->correct_count, $attempt->passed ? 'Đạt' : 'Không đạt', optional($attempt->submitted_at)->format('d/m/Y H:i'),
            $attempt->violation_count, $attempt->isFlagged() ? 'Có' : '', $attempt->violations->map(fn ($violation) => $violation->occurred_at->format('H:i:s d/m/Y').' - '.(ExamAttemptViolation::LABELS[$violation->type] ?? $violation->type))->implode('; ')];
    }

    public function styles(Worksheet $sheet): array
    {
        return [1 => ['font' => ['bold' => true], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DBEAFE']]]];
    }
}
