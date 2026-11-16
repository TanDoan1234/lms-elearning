<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return ['name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($this->route('category'))], 'description' => 'nullable|string|max:2000'];
    }

    public function messages(): array
    {
        return ['name.required' => 'Tên danh mục là bắt buộc.', 'name.unique' => 'Tên danh mục đã tồn tại.'];
    }

    public function attributes(): array
    {
        return ['name' => 'Tên danh mục', 'description' => 'Mô tả'];
    }
}
