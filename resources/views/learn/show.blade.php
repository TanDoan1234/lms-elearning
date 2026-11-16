<x-app-layout>
<div class="min-h-[calc(100vh-4rem)] bg-slate-100 lg:grid lg:grid-cols-[330px_1fr]">
    <aside class="border-r border-slate-200 bg-white text-slate-700 lg:sticky lg:top-16 lg:h-[calc(100vh-4rem)] lg:overflow-y-auto">
        <div class="border-b border-slate-200 p-5"><a href="{{ route('courses.show',$course) }}" class="text-xs font-semibold text-primary-700">← Về khóa học</a><h1 class="mt-3 line-clamp-2 font-bold leading-6 text-slate-950">{{ $course->title }}</h1><div class="mt-5"><x-progress-bar :value="$percent" label="Tiến độ khóa học"/></div></div>
        <nav class="p-3" aria-label="Nội dung khóa học">
            @foreach($course->sections as $section)
                @php
                    $sectionCompleted = $section->lessons->filter(fn ($item) => $completedIds->contains($item->id))->count();
                @endphp
                <div class="mb-4"><div class="flex items-center justify-between px-3 py-2 text-xs font-bold uppercase tracking-wider text-slate-400"><h2>{{ $loop->iteration }}. {{ $section->title }}</h2><span>{{ $sectionCompleted }}/{{ $section->lessons->count() }}</span></div><div class="space-y-1">
                    @foreach($section->lessons as $item)
                        @php
                            $done = $completedIds->contains($item->id);
                            $current = $item->is($lesson);
                        @endphp
                        <a class="flex items-start gap-3 rounded-lg px-3 py-3 text-sm {{ $current?'bg-primary-50 text-primary-700':($done?'text-slate-700':'text-slate-500 hover:text-slate-900') }}" href="{{ route('learn.show',[$course,$item]) }}" aria-current="{{ $current?'page':'false' }}">
                            <span data-check="{{ $item->id }}" class="mt-0.5 grid h-5 w-5 shrink-0 place-items-center rounded-full border text-[10px] {{ $done?'border-emerald-500 bg-emerald-500 text-white':($current?'border-primary-600 bg-primary-600 text-white':'border-slate-300') }}">{{ $done?'✓':($current?'▶':$loop->iteration) }}</span>
                            <span class="leading-5">{{ $item->title }}<small class="mt-1 block {{ $current?'text-primary-600':'text-slate-500' }}">{{ $done?'Đã học':($current?'Đang học':($nextPending?->is($item)?'Tiếp theo':'Chưa học')) }}</small></span>
                        </a>
                    @endforeach
                </div></div>
            @endforeach
        </nav>
    </aside>
    <main class="min-w-0"><div class="mx-auto max-w-5xl p-4 sm:p-8 lg:p-10">
        <div class="mb-6"><p class="text-sm font-semibold text-primary-700">Bài {{ $lesson->position }}</p><h2 class="mt-2 text-2xl font-bold text-slate-950 sm:text-3xl">{{ $lesson->title }}</h2></div>
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-slate-100">@if($lesson->type==='video'&&$lesson->video_url)<div class="aspect-video"><iframe id="youtube-player" class="h-full w-full" src="{{ $lesson->embed_url }}" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" title="Video bài học" allowfullscreen></iframe></div>@elseif($lesson->type==='video'&&$lesson->video_path)<video id="lesson-video" controls class="aspect-video w-full"><source src="{{ asset('storage/'.$lesson->video_path) }}"></video>@elseif($lesson->document_path)<div class="grid min-h-72 place-items-center p-8 text-center text-slate-900"><div><div class="text-5xl text-primary-600">▤</div><h3 class="mt-4 text-xl font-bold">Tài liệu bài học</h3><a class="mt-5 inline-block rounded-md bg-primary-700 px-5 py-3 font-semibold text-white" target="_blank" href="{{ asset('storage/'.$lesson->document_path) }}">Mở tài liệu ↗</a></div></div>@else<div class="grid min-h-64 place-items-center text-slate-500">Nội dung đa phương tiện đang được cập nhật</div>@endif</div>
        @if($lesson->content)<x-card class="mt-7"><h3 class="text-lg font-bold text-slate-900">Nội dung bài học</h3><div class="mt-4 whitespace-pre-line leading-8 text-slate-600">{{ $lesson->content }}</div></x-card>@endif
        @if($next)<p class="mt-7 rounded-lg border border-slate-200 bg-white px-4 py-3 text-sm text-slate-600"><span class="font-semibold text-slate-900">Bài tiếp theo:</span> {{ $next->title }}</p>@endif
        <div class="mt-4 flex flex-wrap items-center justify-between gap-4">@auth<button id="complete-lesson" data-url="{{ route('lessons.complete',$lesson) }}" class="rounded-md bg-emerald-700 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-800 disabled:opacity-60">✓ Đánh dấu hoàn thành</button>@endauth<div class="ml-auto flex gap-2">@if($previous)<a class="rounded-md border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:border-slate-400" href="{{ route('learn.show',[$course,$previous]) }}">← Bài trước</a>@endif @if($next)<a class="rounded-md bg-primary-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-800" href="{{ route('learn.show',[$course,$next]) }}">Bài tiếp →</a>@endif</div></div>
    </div></main>
</div>
@push('scripts')<script>const completeButton=document.getElementById('complete-lesson');async function completeLesson(){if(!completeButton||completeButton.disabled)return;completeButton.disabled=true;const response=await fetch(completeButton.dataset.url,{method:'POST',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,'Content-Type':'application/json','Accept':'application/json'},body:JSON.stringify({completed:true})});if(!response.ok){completeButton.disabled=false;return}const data=await response.json();completeButton.textContent=data.course_completed?'Đã hoàn thành khóa học ✓':`Đã hoàn thành · ${data.progress}%`}completeButton?.addEventListener('click',completeLesson);document.getElementById('lesson-video')?.addEventListener('ended',completeLesson);if(document.getElementById('youtube-player')){const tag=document.createElement('script');tag.src='https://www.youtube.com/iframe_api';document.head.appendChild(tag);window.onYouTubeIframeAPIReady=()=>new window.YT.Player('youtube-player',{events:{onStateChange:event=>{if(event.data===window.YT.PlayerState.ENDED)completeLesson()}}})}</script>@endpush
</x-app-layout>
