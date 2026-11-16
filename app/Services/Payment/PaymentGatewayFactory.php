<?php

namespace App\Services\Payment;

use InvalidArgumentException;

class PaymentGatewayFactory
{
    public function make(string $method): PaymentGatewayInterface
    {
        return match ($method) {
            'card' => app(MockPaymentGateway::class), 'bank_transfer' => app(BankTransferGateway::class), default => throw new InvalidArgumentException('Phương thức thanh toán không hợp lệ.')
        };
    }
}
