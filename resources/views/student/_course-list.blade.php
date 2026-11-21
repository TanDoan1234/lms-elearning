@php
    $activeTab = request('tab', $defaultTab ?? 'learning');
@endphp
@if($showTabs ?? false)
    <nav class="mb-5 flex gap-6 border-b border-slate-200 text-sm font-semibold" aria-label="Lọc khóa học">
        <a href="?tab=learning" class="border-b-2 pb-3 {{ $activeTab === 'learning' ? 'border-primary-700 text-primary-700' : 'border-transparent text-slate-500' }}">Đang học ({{ $learningCount }})</a>
        <a href="?tab=completed" class="border-b-2 pb-3 {{ $activeTab === 'completed' ? 'border-primary-700 text-primary-700' : 'border-transparent text-slate-500' }}">Đã hoàn thành ({{ $completedCount }})</a>
    </nav>
@endif
<div class="space-y-4">
    @php
        $visibleCourses = ($showTabs ?? false) && in_array($activeTab, ['learning', 'completed'], true)
            ? $courses->getCollection()->filter(fn ($course) => $activeTab === 'completed' ? $progressByCourse[$course->id] >= 100 : $progressByCourse[$course->id] < 100)
            : $courses->getCollection();
    @endphp
    @forelse($visibleCourses as $course)
        @php
            $detail = $courseDetails[$course->id];
            $certificate = $certificatesByCourse->get($course->id);
            $progressValue = $progressByCourse[$course->id];
        @endphp
        <article class="grid gap-5 rounded-lg border border-slate-200 bg-white p-5 sm:grid-cols-[128px_1fr_auto] sm:items-center">
            <div class="aspect-[4/3] overflow-hidden rounded-md"><x-course-image :course="$course" /></div>
            <div class="min-w-0"><p class="text-xs font-semibold uppercase tracking-wider text-primary-700">{{ $course->category->name }}</p><h2 class="mt-1 font-bold text-slate-950">{{ $course->title }}</h2>
                <div class="mt-4 grid gap-2 text-sm text-slate-600 sm:grid-cols-3"><p><span class="block text-xs text-slate-400">Bài học</span><strong>{{ $detail['completed'] }}/{{ $detail['total'] }}</strong></p><p><span class="block text-xs text-slate-400">Bài kiểm tra</span><strong class="{{ $detail['quiz_status'] === 'Không có' ? 'font-medium text-slate-400' : '' }}">{{ $detail['quiz_status'] }}</strong></p><p><span class="block text-xs text-slate-400">Thi cuối khóa</span><strong class="{{ in_array($certificate ? 'Hoàn tất' : $detail['final_status'], ['Chưa có','Chưa thi'], true) ? 'font-medium text-slate-400' : '' }}">{{ $certificate ? 'Hoàn tất' : $detail['final_status'] }}</strong></p></div>
            </div>
            <div class="flex items-center gap-4 sm:flex-col sm:items-end"><div class="grid h-16 w-16 shrink-0 place-items-center rounded-full border-[6px] border-slate-200 text-sm font-bold text-slate-900" aria-label="Tiến độ {{ $progressValue }} phần trăm">{{ $progressValue }}%</div><div class="min-w-[150px]">
                @if($certificate)<a class="block rounded-md bg-emerald-700 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-emerald-800" href="{{ route('certificates.download', [$certificate, 'inline' => 1]) }}" target="_blank" rel="noopener">Xem chứng chỉ</a><p class="mt-2 text-center text-[10px] text-slate-500">{{ $certificate->code }}</p>
                @elseif($progressValue >= 100 && $course->finalExam)@php($finalState=$course->finalExam->windowState())@if($finalState==='open')<a class="block rounded-md bg-amber-600 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-amber-700" href="{{ route('exams.show',$course->finalExam) }}">Làm bài thi cuối khóa</a>@elseif($finalState==='upcoming')<a class="block rounded-md border border-slate-300 bg-white px-4 py-2.5 text-center text-sm font-semibold text-slate-700" href="{{ route('exams.show',$course->finalExam) }}">Thi cuối khóa mở lúc {{ $course->finalExam->starts_at->format('d/m H:i') }}</a>@else<a class="block rounded-md border border-slate-300 bg-slate-50 px-4 py-2.5 text-center text-sm font-semibold text-slate-500" href="{{ route('exams.show',$course->finalExam) }}">Thi cuối khóa đã đóng</a>@endif
                @else<a class="block rounded-md bg-primary-700 px-4 py-2.5 text-center text-sm font-semibold text-white hover:bg-primary-800" href="{{ route('learn.show',$course) }}">Tiếp tục học</a>@endif
            </div></div>
        </article>
    @empty
        <x-empty-state title="Chưa có khóa học trong mục này" description="Khám phá danh mục và đăng ký khóa học phù hợp."><a href="{{ route('courses.index') }}"><x-button>Khám phá khóa học</x-button></a></x-empty-state>
    @endforelse
</div>
<div class="mt-7">{{ $courses->links() }}</div>
