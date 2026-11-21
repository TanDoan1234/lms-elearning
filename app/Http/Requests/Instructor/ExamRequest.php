<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'shuffle_questions' => $this->boolean('shuffle_questions'),
            'is_final' => $this->boolean('is_final'),
            'anti_cheat_enabled' => $this->boolean('anti_cheat_enabled'),
            'max_violations' => $this->filled('max_violations') ? $this->input('max_violations') : 3,
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string'],
            'duration_minutes' => ['required', 'integer', 'between:1,300'], 'pass_score' => ['required', 'numeric', 'between:0,100'],
            'max_attempts' => ['required', 'integer', 'min:0'], 'shuffle_questions' => ['boolean'], 'is_final' => ['boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', Rule::when($this->filled('starts_at'), ['after:starts_at'])],
            'anti_cheat_enabled' => ['boolean'], 'max_violations' => ['required', 'integer', 'between:0,20'],
            'status' => ['required', Rule::in(['draft', 'published'])], 'selection_mode' => ['required', Rule::in(['manual', 'random'])],
            'questions' => ['required_if:selection_mode,manual', 'array'], 'questions.*.selected' => ['nullable', 'boolean'],
            'questions.*.points' => ['nullable', 'numeric', 'min:0.01', 'max:100'],
            'random.easy' => ['required_if:selection_mode,random', 'integer', 'min:0'],
            'random.medium' => ['required_if:selection_mode,random', 'integer', 'min:0'],
            'random.hard' => ['required_if:selection_mode,random', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return ['required' => ':attribute là bắt buộc.', 'between' => ':attribute phải từ :min đến :max.', 'required_if' => ':attribute là bắt buộc với cách chọn này.', 'ends_at.after' => 'Thời gian đóng đề phải sau thời gian mở đề.'];
    }

    public function attributes(): array
    {
        return ['title' => 'Tên đề thi', 'duration_minutes' => 'Thời gian làm bài', 'pass_score' => 'Điểm đạt', 'max_attempts' => 'Số lần thi', 'questions' => 'Câu hỏi', 'starts_at' => 'Thời gian mở đề', 'ends_at' => 'Thời gian đóng đề', 'max_violations' => 'Số lần vi phạm cho phép', 'random.easy' => 'Số câu dễ', 'random.medium' => 'Số câu trung bình', 'random.hard' => 'Số câu khó'];
    }
}
