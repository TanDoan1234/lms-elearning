<?php

namespace App\Services\Payment;

final readonly class PaymentResult
{
    public function __construct(public bool $successful, public string $message, public ?string $transactionId = null) {}

    public static function success(string $message = 'Thanh toán thành công.', ?string $transactionId = null): self
    {
        return new self(true, $message, $transactionId);
    }

    public static function failure(string $message): self
    {
        return new self(false, $message);
    }
}
