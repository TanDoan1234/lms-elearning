<x-app-layout>
    <x-slot name="header"><p class="text-xs font-semibold uppercase tracking-wider text-primary-700">Không gian học tập</p><h1 class="page-title mt-2">Tổng quan học tập</h1></x-slot>
    <div class="page-container space-y-8 py-10">
        <section class="flex flex-col gap-5 rounded-lg border border-slate-200 bg-white p-6 sm:flex-row sm:items-center">
            <span class="grid h-16 w-16 shrink-0 place-items-center rounded-full bg-primary-100 text-xl font-bold text-primary-700">{{ mb_strtoupper(mb_substr(auth()->user()->name, 0, 1)) }}</span>
            <div class="min-w-0 flex-1"><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Hồ sơ học viên</p><h2 class="mt-1 truncate text-2xl font-bold text-slate-950">{{ auth()->user()->name }}</h2><p class="mt-1 text-sm text-slate-500">{{ $stats['active'] ? 'Đang theo học '.$stats['active'].' chương trình' : 'Sẵn sàng bắt đầu chương trình đầu tiên' }}</p></div>
            <a href="{{ route('profile.edit') }}" class="text-sm font-semibold text-primary-700 hover:underline">Cập nhật hồ sơ</a>
        </section>

        <section><div class="mb-4 flex items-end justify-between"><div><p class="text-xs font-semibold uppercase tracking-wider text-primary-700">Học tiếp</p><h2 class="mt-1 text-2xl font-bold text-slate-950">Tiếp tục học</h2></div></div>
            <div class="grid gap-4 lg:grid-cols-3">@forelse($continueCourses as $course)@php
                $nextLesson = $nextLessonByCourse[$course->id];
                $detail = $courseDetails[$course->id];
            @endphp
                <article class="rounded-lg border border-slate-200 bg-white p-5"><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Bài {{ $detail['completed'] + 1 }}/{{ max(1,$detail['total']) }}</p><h3 class="mt-2 line-clamp-2 font-bold text-slate-950">{{ $course->title }}</h3><p class="mt-2 line-clamp-1 text-sm text-slate-500">Tiếp theo: {{ $nextLesson?->title ?? 'Ôn tập nội dung khóa học' }}</p><div class="mt-4"><x-progress-bar :value="$progressByCourse[$course->id]" label="Tiến độ"/></div><a href="{{ $nextLesson ? route('learn.show',[$course,$nextLesson]) : route('learn.show',$course) }}" class="mt-4 block rounded-md bg-primary-700 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-primary-800">Tiếp tục →</a></article>
            @empty<x-empty-state class="lg:col-span-3" title="Bạn đã hoàn thành các bài hiện có" description="Khám phá thêm khóa học để tiếp tục hành trình."/>@endforelse</div>
        </section>

        <section class="grid overflow-hidden rounded-lg border border-slate-200 bg-white sm:grid-cols-2 lg:grid-cols-4">@foreach(['active'=>'Khóa học đang tham gia','completed'=>'Khóa học đã hoàn thành','certificates'=>'Chứng chỉ đã nhận','attempts'=>'Bài thi đã làm'] as $k=>$label)<div class="border-b border-slate-200 p-5 sm:border-r lg:border-b-0"><p class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ $label }}</p><p class="mt-2 text-2xl font-bold text-slate-950">{{ $stats[$k] }}</p></div>@endforeach</section>

        <div class="grid items-start gap-6 xl:grid-cols-[1fr_320px]">
            <div><div class="mb-5 flex items-end justify-between"><div><p class="text-xs font-semibold uppercase tracking-wider text-primary-700">Chương trình</p><h2 class="mt-1 text-2xl font-bold text-slate-950">Khóa học của tôi</h2></div><a class="text-sm font-semibold text-primary-700 hover:underline" href="{{ route('student.courses') }}">Xem tất cả</a></div>
                @include('student._course-list', ['showTabs' => true, 'defaultTab' => 'all'])
            </div>
            <aside class="space-y-6"><section class="rounded-lg border border-slate-200 bg-white p-5"><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Sắp tới</p><h2 class="mt-1 text-lg font-bold text-slate-950">Cần hoàn thành</h2><div class="mt-4 divide-y divide-slate-100">@forelse($upcomingItems as $item)<div class="py-3"><p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">{{ $item['label'] }}</p><p class="mt-1 text-sm font-semibold text-slate-900">{{ $item['title'] }}</p><p class="mt-1 text-xs text-slate-500">{{ $item['course']->title }}</p><a class="mt-2 inline-block text-xs font-semibold text-primary-700 hover:underline" href="{{ $item['url'] }}">{{ $item['type'] === 'exam' ? 'Xem bài thi' : 'Học tiếp' }} →</a></div>@empty<p class="py-4 text-sm text-slate-500">Không có nội dung đang chờ.</p>@endforelse</div></section></aside>
        </div>
        <x-activity-heatmap :days="$activityDays" />
    </div>
</x-app-layout>
