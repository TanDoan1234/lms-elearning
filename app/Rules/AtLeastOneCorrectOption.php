<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AtLeastOneCorrectOption implements ValidationRule
{
    public function __construct(private readonly string $type) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $correct = collect(is_array($value) ? $value : [])->filter(fn ($item) => filter_var($item, FILTER_VALIDATE_BOOL))->count();

        if ($this->type === 'single' && $correct !== 1) {
            $fail('Câu hỏi một đáp án phải có đúng một đáp án đúng.');
        }

        if ($this->type === 'multiple' && $correct < 1) {
            $fail('Câu hỏi nhiều đáp án phải có ít nhất một đáp án đúng.');
        }
    }
}
