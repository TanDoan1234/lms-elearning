<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function index(Request $r)
    {
        Gate::authorize('admin');
        $orders = Order::with(['user', 'course'])->when($r->status, fn ($q, $v) => $q->where('status', $v))->latest()->paginate(15)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function confirm(Order $order)
    {
        Gate::authorize('admin');
        if ($order->status !== 'pending') {
            return back()->with('error', 'Chỉ có thể xác nhận đơn đang chờ.');
        }DB::transaction(function () use ($order) {
            $order->update(['status' => 'paid', 'paid_at' => now()]);
            if (class_exists(EnrollmentService::class)) {
                app(EnrollmentService::class)->activate($order);
            } else {
                $this->activateInline($order);
            }
        });

        return back()->with('success', 'Đã xác nhận thanh toán và kích hoạt ghi danh.');
    }

    private function activateInline(Order $o): void
    {
        $o->course->students()->syncWithoutDetaching([$o->user_id => ['status' => 'active', 'price_paid' => $o->amount, 'enrolled_at' => now()]]);
    }
}
