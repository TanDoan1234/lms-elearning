<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CheckoutPaymentRequest;
use App\Models\Course;
use App\Models\Order;
use App\Services\EnrollmentService;
use App\Services\Payment\PaymentGatewayFactory;

class CheckoutController extends Controller
{
    public function show(Course $course)
    {
        $order = $this->pendingOrder($course);

        return view('checkout.show', compact('course', 'order'));
    }

    public function pay(CheckoutPaymentRequest $request, Course $course, PaymentGatewayFactory $factory, EnrollmentService $enrollments)
    {
        $order = $this->pendingOrder($course);
        $data = $request->validated();
        $order->update(['method' => $data['method']]);
        $result = $factory->make($data['method'])->charge($order, $data);
        if ($data['method'] === 'bank_transfer') {
            return back()->with('success', $result->message);
        }
        if (! $result->successful) {
            return back()->withInput()->with('error', $result->message);
        }
        $order->update(['status' => 'paid', 'paid_at' => now()]);
        $enrollments->activate($order->fresh(['user', 'course']));

        return redirect()->route('learn.show', $course)->with('success', $result->message);
    }

    private function pendingOrder(Course $course): Order
    {
        return request()->user()->orders()->where('course_id', $course->id)->where('status', 'pending')->latest()->firstOrFail();
    }
}
