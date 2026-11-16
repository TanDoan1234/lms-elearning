<?php

namespace App\Services\Payment;

use App\Models\Order;

class BankTransferGateway implements PaymentGatewayInterface
{
    public function charge(Order $order, array $data): PaymentResult
    {
        return PaymentResult::failure('Đơn hàng đang chờ quản trị viên xác nhận chuyển khoản.');
    }
}
