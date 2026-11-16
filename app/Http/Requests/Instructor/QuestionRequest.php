<?php

namespace App\Http\Requests\Instructor;

use App\Rules\AtLeastOneCorrectOption;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $options = collect($this->input('options', []))->map(fn ($option) => [
            'content' => $option['content'] ?? null,
            'is_correct' => isset($option['is_correct']) && filter_var($option['is_correct'], FILTER_VALIDATE_BOOL),
        ])->values()->all();
        $this->merge(['options' => $options, 'correct_options' => array_column($options, 'is_correct')]);
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:5000'],
            'type' => ['required', Rule::in(['single', 'multiple'])],
            'difficulty' => ['required', Rule::in(['easy', 'medium', 'hard'])],
            'explanation' => ['nullable', 'string', 'max:5000'],
            'options' => ['required', 'array', 'min:2', 'max:6'],
            'options.*.content' => ['required', 'string', 'max:1000', 'distinct'],
            'options.*.is_correct' => ['boolean'],
            'correct_options' => [new AtLeastOneCorrectOption((string) $this->input('type'))],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute là bắt buộc.', 'options.min' => 'Cần ít nhất 2 đáp án.',
            'options.max' => 'Chỉ được tối đa 6 đáp án.', 'options.*.content.distinct' => 'Các đáp án không được trùng nhau.',
        ];
    }

    public function attributes(): array
    {
        return ['content' => 'Nội dung câu hỏi', 'type' => 'Loại câu hỏi', 'difficulty' => 'Độ khó', 'options' => 'Danh sách đáp án', 'options.*.content' => 'Nội dung đáp án'];
    }
}
