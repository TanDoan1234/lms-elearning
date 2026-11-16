@props(['days', 'title' => 'Hoạt động 12 tuần gần nhất'])
@php
    $weeks = collect($days)->chunk(7)->values();
    $colors = ['bg-slate-100', 'bg-primary-100', 'bg-primary-300', 'bg-primary-500', 'bg-primary-700'];
    // Nhãn tháng: đặt ở tuần đầu tiên của mỗi tháng, bỏ nhãn nếu cách nhãn trước < 3 cột để không chồng chữ.
    $monthLabels = [];
    $lastLabelAt = -10;
    $previousMonth = null;
    foreach ($weeks as $i => $week) {
        $month = \Illuminate\Support\Carbon::parse($week->last()['date'])->month;
        if ($month !== $previousMonth && $i - $lastLabelAt >= 3) {
            $monthLabels[$i] = 'Thg '.$month;
            $lastLabelAt = $i;
        }
        $previousMonth = $month;
    }
@endphp
<section {{ $attributes->class('rounded-lg border border-slate-200 bg-white p-5') }}>
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div><p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Nhịp độ học tập</p><h2 class="mt-1 text-lg font-bold text-slate-950">{{ $title }}</h2></div>
        <div class="flex items-center gap-1 text-xs text-slate-500" aria-hidden="true"><span>Ít</span>@foreach($colors as $color)<span class="h-3 w-3 rounded-sm {{ $color }}"></span>@endforeach<span>Nhiều</span></div>
    </div>
    <div class="mt-5 overflow-x-auto pb-2">
        <div class="w-max" role="img" aria-label="Biểu đồ hoạt động trong 12 tuần">
            <div class="ml-7 flex gap-1" aria-hidden="true">
                @foreach($weeks as $i => $week)
                    <span class="relative h-4 w-4 shrink-0 text-[9px] text-slate-400">@isset($monthLabels[$i])<span class="absolute left-0 whitespace-nowrap">{{ $monthLabels[$i] }}</span>@endisset</span>
                @endforeach
            </div>
            <div class="mt-1 flex gap-1">
                <div class="flex w-6 shrink-0 flex-col gap-1 text-[9px] leading-4 text-slate-400" aria-hidden="true"><span>T2</span><span>&nbsp;</span><span>T4</span><span>&nbsp;</span><span>T6</span><span>&nbsp;</span><span>&nbsp;</span></div>
                <div class="flex gap-1">
                    @foreach($weeks as $week)
                        <div class="flex shrink-0 flex-col gap-1">
                            @foreach($week as $day)<span title="{{ $day['label'] }}: {{ $day['count'] }} hoạt động" aria-label="{{ $day['label'] }}: {{ $day['count'] }} hoạt động" class="block h-4 w-4 rounded-sm {{ $colors[$day['level']] }}"></span>@endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
