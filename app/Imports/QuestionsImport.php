<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class QuestionsImport implements SkipsOnFailure, ToCollection, WithHeadingRow, WithValidation
{
    /** @var array<int, Failure> */
    private array $failures = [];

    public function __construct(private readonly Course $course, private readonly User $creator) {}

    public function collection(Collection $rows): void
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $index => $row) {
                $answers = collect(explode(',', strtoupper((string) $row['dap_an_dung'])))->map(fn ($v) => trim($v))->filter()->unique();
                $letters = ['A', 'B', 'C', 'D', 'E', 'F'];
                $options = collect($letters)->map(fn ($letter) => ['content' => trim((string) ($row['dap_an_'.strtolower($letter)] ?? '')), 'is_correct' => $answers->contains($letter)])->filter(fn ($option) => $option['content'] !== '')->values();
                if (($row['loai'] === 'single' && $answers->count() !== 1) || ($row['loai'] === 'multiple' && $answers->isEmpty()) || $answers->diff($letters)->isNotEmpty()) {
                    $this->failures[] = new Failure($index + 2, 'dap_an_dung', ['Đáp án đúng không hợp lệ với loại câu hỏi.'], $row->toArray());

                    continue;
                }
                $question = $this->course->questions()->create(['created_by' => $this->creator->id, 'content' => $row['noi_dung'], 'type' => $row['loai'], 'difficulty' => $row['do_kho'], 'explanation' => $row['giai_thich'] ?: null]);
                $question->options()->createMany($options->all());
            }
        });
    }

    public function rules(): array
    {
        return ['*.noi_dung' => ['required', 'string'], '*.loai' => ['required', Rule::in(['single', 'multiple'])], '*.do_kho' => ['required', Rule::in(['easy', 'medium', 'hard'])], '*.dap_an_a' => ['required'], '*.dap_an_b' => ['required'], '*.dap_an_dung' => ['required', 'string']];
    }

    public function customValidationMessages(): array
    {
        return ['required' => ':attribute là bắt buộc.', 'in' => ':attribute không đúng định dạng.'];
    }

    public function customValidationAttributes(): array
    {
        return ['noi_dung' => 'nội dung', 'loai' => 'loại', 'do_kho' => 'độ khó', 'dap_an_a' => 'đáp án A', 'dap_an_b' => 'đáp án B', 'dap_an_dung' => 'đáp án đúng'];
    }

    public function onFailure(Failure ...$failures): void
    {
        array_push($this->failures, ...$failures);
    }

    /** @return array<int, Failure> */
    public function failures(): array
    {
        return $this->failures;
    }
}
