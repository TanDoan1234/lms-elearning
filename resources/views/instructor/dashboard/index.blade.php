@extends('layouts.admin')
@section('content')
<div class="mb-7">
    <p class="text-sm font-semibold text-primary-700">Không gian giảng dạy</p>
    <h1 class="page-title mt-2">Xin chào, {{ auth()->user()->name }}</h1>
    <p class="page-subtitle">Hoạt động học tập và kết quả thi trong các khóa học của bạn.</p>
</div>

<section class="grid overflow-hidden rounded-lg border border-slate-200 bg-white sm:grid-cols-2 xl:grid-cols-5">
    @foreach (['courses' => 'Khóa học quản lý', 'students' => 'Học viên đang học', 'attempts' => 'Lượt thi đã nộp', 'pass_rate' => 'Tỷ lệ đạt', 'avg_score' => 'Điểm trung bình'] as $k => $label)
        <div class="border-b border-slate-200 p-5 sm:border-r xl:border-b-0">
            <p class="text-sm text-slate-500">{{ $label }}</p>
            <p class="mt-2 text-2xl font-bold text-slate-950">{{ number_format($stats[$k], in_array($k, ['pass_rate', 'avg_score']) ? 1 : 0, ',', '.') }}{{ in_array($k, ['pass_rate', 'avg_score']) ? '%' : '' }}</p>
        </div>
    @endforeach
</section>

<div class="mt-6 grid items-start gap-6 xl:grid-cols-[320px_1fr]">
    <x-card title="Cần xử lý">
        <div class="divide-y divide-slate-100 text-sm">
            <div class="flex items-center justify-between py-3"><span class="font-medium text-slate-700">Khóa học bản nháp</span><strong>{{ $needsAttention['draft_courses'] }}</strong></div>
            <div class="flex items-center justify-between py-3"><span class="font-medium text-slate-700">Đề thi chưa có câu hỏi</span><strong class="text-amber-700">{{ $needsAttention['empty_exams'] }}</strong></div>
            <div class="flex items-center justify-between py-3"><span class="font-medium text-slate-700">Đề thi chưa xuất bản</span><strong>{{ $needsAttention['draft_exams'] }}</strong></div>
        </div>
    </x-card>
    <x-activity-heatmap :days="$activityDays" title="Hoạt động học tập trong khóa của bạn" />
</div>

<div class="mt-7 grid gap-6 xl:grid-cols-[1fr_380px]">
    <x-card title="Ghi danh 6 tháng gần nhất"><x-bar-chart :data="$enrollmentsByMonth"/></x-card>
    <x-card title="Ghi danh gần đây">
        <div class="divide-y divide-slate-100">
            @forelse ($recentEnrollments as $e)
                <div class="flex items-center gap-3 py-2.5">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-slate-100 text-sm font-bold text-slate-700">{{ mb_strtoupper(mb_substr(\Illuminate\Support\Str::afterLast($e->student_name, ' '), 0, 1)) }}</span>
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-slate-800">{{ $e->student_name }}</p>
                        <p class="truncate text-xs text-slate-500">{{ $e->course_title }} · {{ \Illuminate\Support\Carbon::parse($e->enrolled_at)->format('d/m/Y') }}</p>
                    </div>
                </div>
            @empty
                <p class="py-8 text-center text-sm text-slate-500">Chưa có ghi danh mới.</p>
            @endforelse
        </div>
    </x-card>
</div>

<x-card title="Khóa học của tôi" class="mt-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-slate-200 text-xs uppercase tracking-wide text-slate-500">
                <tr><th class="py-3 pr-4">Khóa học</th><th class="py-3 pr-4">Danh mục</th><th class="py-3 pr-4">Trạng thái</th><th class="py-3 pr-4 text-right">Bài học</th><th class="py-3 pr-4 text-right">Đề thi</th><th class="py-3 pr-4 text-right">Học viên</th><th class="py-3"></th></tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($courses as $c)
                    <tr>
                        <td class="py-3 pr-4 font-semibold text-slate-800">{{ $c->title }}</td>
                        <td class="py-3 pr-4 text-slate-600">{{ $c->category->name }}</td>
                        <td class="py-3 pr-4"><x-badge :variant="$c->status === 'published' ? 'green' : 'gray'">{{ $c->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}</x-badge></td>
                        <td class="py-3 pr-4 text-right text-slate-700">{{ $c->lessons_count }}</td>
                        <td class="py-3 pr-4 text-right text-slate-700">{{ $c->exams_count }}</td>
                        <td class="py-3 pr-4 text-right font-semibold text-slate-800">{{ $c->active_students_count }}</td>
                        <td class="py-3 text-right"><a href="{{ route('instructor.courses.show', $c) }}" class="text-sm font-semibold text-primary-700 hover:underline">Quản lý</a></td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="py-8 text-center text-slate-500">Chưa có khóa học.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-card>
@endsection
