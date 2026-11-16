<?php

namespace App\Services\Payment;

use App\Models\Order;

class MockPaymentGateway implements PaymentGatewayInterface
{
    public function charge(Order $order, array $data): PaymentResult
    {
        $number = preg_replace('/\D/', '', (string) ($data['card_number'] ?? ''));
        if ($number === '4000000000000002') {
            return PaymentResult::failure('Thẻ bị từ chối trong môi trường mô phỏng.');
        }
        if ($number === '4242424242424242' || $this->passesLuhn($number)) {
            return PaymentResult::success('Thanh toán thẻ thành công.', 'MOCK-'.strtoupper(bin2hex(random_bytes(4))));
        }

        return PaymentResult::failure('Số thẻ không hợp lệ.');
    }

    private function passesLuhn(string $number): bool
    {
        if (strlen($number) < 12) {
            return false;
        }
        $sum = 0;
        $parity = strlen($number) % 2;
        foreach (str_split($number) as $index => $digit) {
            $value = (int) $digit;
            if ($index % 2 === $parity && ($value *= 2) > 9) {
                $value -= 9;
            }
            $sum += $value;
        }

        return $sum % 10 === 0;
    }
}
