<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CheckoutPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isStudent() ?? false;
    }

    public function rules(): array
    {
        return ['method' => ['required', Rule::in(['card', 'bank_transfer'])], 'card_number' => ['required_if:method,card', 'nullable', 'string', 'max:30']];
    }

    public function messages(): array
    {
        return ['method.required' => 'Vui lòng chọn phương thức thanh toán.', 'method.in' => 'Phương thức thanh toán không hợp lệ.', 'card_number.required_if' => 'Vui lòng nhập số thẻ mô phỏng.'];
    }

    public function attributes(): array
    {
        return ['method' => 'phương thức thanh toán', 'card_number' => 'số thẻ'];
    }
}
