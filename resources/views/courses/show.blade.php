<x-app-layout>
    <section class="border-b border-slate-200 bg-slate-50 text-slate-950">
        <div class="page-container py-12 lg:py-16"><div class="max-w-3xl">
            <p class="text-sm font-semibold text-primary-700"><a href="{{ route('courses.index') }}">Khóa học</a> / {{ $course->category->name }}</p>
            <h1 class="mt-5 text-3xl font-bold leading-tight sm:text-4xl">{{ $course->title }}</h1>
            <p class="mt-5 text-lg leading-8 text-slate-600">{{ $course->short_description ?? $course->description }}</p>
            <div class="mt-6 flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-600"><span>Giảng viên: <strong class="ml-1 text-slate-900">{{ $course->instructor->name }}</strong></span><span>{{ $course->students_count }} học viên</span><span>{{ ['beginner'=>'Cơ bản','intermediate'=>'Trung cấp','advanced'=>'Nâng cao'][$course->level] ?? $course->level }}</span></div>
        </div></div>
    </section>
    <div class="page-container grid items-start gap-8 py-10 lg:grid-cols-[1fr_340px]">
        <main>
            <x-card title="Giới thiệu khóa học"><div class="whitespace-pre-line leading-7 text-slate-600">{{ $course->description }}</div></x-card>
            <section class="mt-8">
                <div class="mb-4 flex items-end justify-between"><h2 class="text-2xl font-bold text-slate-950">Nội dung khóa học</h2><span class="text-sm text-slate-500">{{ $course->sections->sum(fn($section) => $section->lessons->count()) }} bài học</span></div>
                <div class="space-y-3" x-data="{ open: 0 }">
                    @foreach($course->sections as $section)
                        @php($sectionLabel = str_starts_with(mb_strtolower(trim($section->title)), 'chương') ? $section->title : 'Chương '.$loop->iteration.' · '.$section->title)
                        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                            <button @click="open = open === {{ $loop->index }} ? -1 : {{ $loop->index }}" class="flex w-full items-center justify-between p-5 text-left font-bold text-slate-900"><span>{{ $sectionLabel }}</span><svg class="h-5 w-5 transition" :class="open === {{ $loop->index }} && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="m6 9 6 6 6-6"/></svg></button>
                            <div x-show="open === {{ $loop->index }}" x-transition class="border-t border-slate-100"><ul class="divide-y divide-slate-100">
                                @foreach($section->lessons as $lesson)
                                    <li class="flex items-center gap-3 px-5 py-3.5 text-sm"><span class="text-primary-500">{{ $lesson->type === 'video' ? '▶' : '▤' }}</span><span class="flex-1 text-slate-700">{{ $lesson->title }}</span>@if($lesson->duration_minutes)<span class="text-xs text-slate-400">{{ $lesson->duration_minutes }} phút</span>@endif @if($lesson->is_preview)<a class="font-semibold text-primary-600" href="{{ route('learn.show', [$course, $lesson]) }}">Học thử</a>@endif</li>
                                @endforeach
                            </ul></div>
                        </div>
                    @endforeach
                </div>
            </section>
        </main>
        <aside class="lg:sticky lg:top-24"><div class="overflow-hidden rounded-lg border border-slate-200 bg-white">
            <div class="aspect-video overflow-hidden"><x-course-image :course="$course" /></div>
            <div class="p-6"><p class="text-3xl font-bold {{ $course->is_free ? 'text-emerald-600' : 'text-slate-950' }}"><x-price :value="$course->price" :free="$course->is_free" /></p><div class="mt-5">
                @auth
                    @if($enrollment?->status === 'active')<a class="block rounded-lg bg-primary-600 px-4 py-3 text-center font-semibold text-white hover:bg-primary-700" href="{{ route('learn.show', $course) }}">Tiếp tục học</a>
                    @elseif($pendingOrder)<a class="block rounded-lg bg-amber-500 px-4 py-3 text-center font-semibold text-white hover:bg-amber-600" href="{{ route('checkout.show', $course) }}">Tiếp tục thanh toán</a>
                    @else<form method="POST" action="{{ route('courses.enroll', $course) }}">@csrf<x-button class="w-full" size="lg">Đăng ký học ngay</x-button></form>@endif
                @else<a class="block rounded-lg bg-primary-600 px-4 py-3 text-center font-semibold text-white" href="{{ route('login') }}">Đăng nhập để đăng ký</a>@endauth
            </div><ul class="mt-6 space-y-3 border-t pt-5 text-sm text-slate-600"><li>✓ Học theo tốc độ của bạn</li><li>✓ Theo dõi tiến độ từng bài</li><li>✓ Chứng chỉ sau khi hoàn thành</li></ul></div>
        </div></aside>
    </div>
</x-app-layout>
