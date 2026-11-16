<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnrollmentService
{
    public function enroll(User $user, Course $course): ?Order
    {
        return DB::transaction(function () use ($user, $course) {
            $active = $course->is_free;
            $user->enrolledCourses()->syncWithoutDetaching([$course->id => ['status' => $active ? 'active' : 'pending', 'price_paid' => $active ? 0 : $course->price, 'enrolled_at' => $active ? now() : null]]);
            if ($active) {
                return null;
            }

            return Order::firstOrCreate(['user_id' => $user->id, 'course_id' => $course->id, 'status' => 'pending'], ['code' => $this->uniqueCode(), 'amount' => $course->price, 'method' => 'bank_transfer']);
        });
    }

    public function activate(Order $order): void
    {
        DB::transaction(fn () => $order->user->enrolledCourses()->syncWithoutDetaching([$order->course_id => ['status' => 'active', 'price_paid' => $order->amount, 'enrolled_at' => now()]]));
    }

    private function uniqueCode(): string
    {
        do {
            $code = 'ORD-'.now()->format('Ymd').'-'.Str::upper(Str::random(4));
        } while (Order::where('code', $code)->exists());

        return $code;
    }
}
