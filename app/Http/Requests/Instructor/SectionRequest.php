<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ['title' => 'required|string|max:255', 'position' => 'nullable|integer|min:1'];
    }

    public function messages(): array
    {
        return ['title.required' => 'Tên chương là bắt buộc.', 'position.integer' => 'Thứ tự phải là số nguyên.'];
    }

    public function attributes(): array
    {
        return ['title' => 'Tên chương', 'position' => 'Thứ tự'];
    }
}
