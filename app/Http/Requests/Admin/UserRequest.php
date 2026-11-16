<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        $id = $this->route('user')?->id;

        return ['name' => 'required|string|max:255', 'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)], 'role' => 'required|in:admin,instructor,student', 'password' => [$id ? 'nullable' : 'required', 'string', 'min:8', 'confirmed']];
    }

    public function messages(): array
    {
        return ['required' => ':attribute là bắt buộc.', 'email.email' => 'Email không hợp lệ.', 'email.unique' => 'Email đã được sử dụng.', 'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.', 'password.confirmed' => 'Xác nhận mật khẩu không khớp.', 'role.in' => 'Vai trò không hợp lệ.'];
    }

    public function attributes(): array
    {
        return ['name' => 'Họ tên', 'email' => 'Email', 'role' => 'Vai trò', 'password' => 'Mật khẩu'];
    }
}
