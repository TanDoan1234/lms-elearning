@extends('layouts.admin')
@section('content')
<div class="mb-7">
    <p class="text-sm font-semibold text-primary-700">Tổng quan hệ thống</p>
    <h1 class="page-title mt-2">Chào mừng trở lại, {{ auth()->user()->name }}</h1>
    <p class="page-subtitle">Số liệu học tập, doanh thu và thi cử của toàn hệ thống.</p>
</div>

<section class="overflow-hidden rounded-lg border border-slate-200 bg-white">
    <div class="grid sm:grid-cols-2 xl:grid-cols-4">
        @foreach (['students' => 'Học viên', 'instructors' => 'Giảng viên', 'courses' => 'Khóa học', 'enrollments' => 'Lượt ghi danh', 'revenue' => 'Doanh thu', 'pending_orders' => 'Đơn chờ xác nhận', 'certificates' => 'Chứng chỉ đã cấp', 'pass_rate' => 'Tỷ lệ thi đạt'] as $k => $label)
            <div class="border-b border-slate-200 p-5 sm:border-r">
                <p class="text-sm text-slate-500">{{ $label }}</p>
                <p class="mt-2 text-2xl font-bold text-slate-950">
                    @if ($k === 'revenue')<x-price :value="$stats[$k]" zero="0 ₫"/>
                    @elseif ($k === 'pass_rate'){{ number_format($stats[$k], 1, ',', '.') }}%
                    @else{{ number_format($stats[$k], 0, ',', '.') }}@endif
                </p>
                @if ($k === 'pending_orders' && $stats[$k] > 0)
                    <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="mt-1 inline-block text-xs font-semibold text-primary-700 hover:underline">Xử lý ngay →</a>
                @endif
            </div>
        @endforeach
    </div>
</section>

<div class="mt-6 grid items-start gap-6 xl:grid-cols-[320px_1fr]">
    <x-card title="Cần xử lý">
        <div class="divide-y divide-slate-100">
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="flex items-center justify-between py-3 text-sm"><span class="font-medium text-slate-700">Đơn chờ xác nhận</span><strong class="text-amber-700">{{ $needsAttention['pending_orders'] }}</strong></a>
            <a href="{{ route('admin.courses.index', ['status' => 'draft']) }}" class="flex items-center justify-between py-3 text-sm"><span class="font-medium text-slate-700">Khóa học bản nháp</span><strong class="text-slate-900">{{ $needsAttention['draft_courses'] }}</strong></a>
        </div>
    </x-card>
    <x-activity-heatmap :days="$activityDays" title="Hoạt động toàn hệ thống trong 12 tuần" />
</div>

<div class="mt-7 grid gap-6 xl:grid-cols-2">
    <x-card title="Ghi danh 6 tháng gần nhất"><x-bar-chart :data="$enrollmentsByMonth"/></x-card>
    <x-card title="Doanh thu 6 tháng gần nhất (triệu đồng)"><x-bar-chart :data="$revenueByMonth" money color="bg-emerald-600"/></x-card>
</div>

<x-card title="Khóa học nhiều học viên nhất" class="mt-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 text-xs uppercase tracking-wide text-slate-500">
                <tr><th class="py-3 pr-4">Khóa học</th><th class="py-3 pr-4">Giảng viên</th><th class="py-3 pr-4">Danh mục</th><th class="py-3 pr-4 text-right">Học viên</th><th class="py-3 text-right">Doanh thu</th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($topCourses as $c)
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-slate-800">{{ $c->title }}</td>
                        <td class="py-3 pr-4 text-slate-600">{{ $c->instructor->name }}</td>
                        <td class="py-3 pr-4 text-slate-600">{{ $c->category->name }}</td>
                        <td class="py-3 pr-4 text-right font-semibold text-slate-800">{{ $c->active_students_count }}</td>
                        <td class="py-3 text-right text-slate-800">@if ($c->price > 0)<x-price :value="$c->revenue" zero="0 ₫"/>@else<span class="text-slate-400">Miễn phí</span>@endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-card>

<x-card title="Đơn hàng mới" class="mt-6">
    <div class="divide-y divide-slate-100">
        @forelse ($latestOrders as $o)
            <div class="flex items-center justify-between gap-4 py-3">
                <div>
                    <p class="font-semibold text-slate-800">{{ $o->user->name }} <span class="font-normal text-slate-500">· {{ $o->course->title }}</span></p>
                    <p class="text-xs text-slate-500">{{ $o->code }} · {{ $o->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <x-badge :variant="['paid' => 'green', 'pending' => 'yellow', 'failed' => 'red'][$o->status] ?? 'gray'">{{ ['paid' => 'Đã thanh toán', 'pending' => 'Chờ xác nhận', 'failed' => 'Thất bại'][$o->status] ?? $o->status }}</x-badge>
                    <span class="w-28 text-right font-semibold text-slate-900"><x-price :value="$o->amount"/></span>
                </div>
            </div>
        @empty
            <p class="py-6 text-center text-sm text-slate-500">Chưa có đơn hàng.</p>
        @endforelse
    </div>
</x-card>
@endsection
