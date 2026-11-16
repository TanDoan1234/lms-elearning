<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ['title' => 'required|string|max:255', 'category_id' => 'required|exists:categories,id', 'short_description' => 'nullable|string|max:500', 'description' => 'nullable|string', 'level' => 'required|in:beginner,intermediate,advanced', 'price' => 'required|numeric|min:0', 'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 'status' => 'required|in:draft,published'];
    }

    public function messages(): array
    {
        return ['required' => ':attribute là bắt buộc.', 'category_id.exists' => 'Danh mục không tồn tại.', 'price.min' => 'Học phí không được âm.', 'thumbnail.image' => 'Ảnh đại diện không hợp lệ.', 'thumbnail.mimes' => 'Ảnh phải là JPG, PNG hoặc WebP.', 'thumbnail.max' => 'Ảnh tối đa 2 MB.'];
    }

    public function attributes(): array
    {
        return ['title' => 'Tiêu đề', 'category_id' => 'Danh mục', 'level' => 'Trình độ', 'price' => 'Học phí', 'status' => 'Trạng thái', 'thumbnail' => 'Ảnh đại diện'];
    }
}
