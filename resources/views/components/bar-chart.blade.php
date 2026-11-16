@props(['data' => [], 'money' => false, 'color' => 'bg-primary-600'])
@php($max = max(1, ...array_values($data ?: [0])))
<div {{ $attributes->merge(['class' => 'flex h-56 items-end gap-3']) }}>
    @foreach ($data as $label => $value)
        <div class="flex h-full flex-1 flex-col items-center justify-end gap-2">
            <span class="text-xs font-semibold text-slate-700">{{ $money ? number_format($value / 1000000, 1, ',', '.').'tr' : number_format($value, 0, ',', '.') }}</span>
            <div class="w-full max-w-12 rounded-t {{ $color }}" style="height: {{ max(2, round($value / $max * 100)) }}%" title="{{ $label }}: {{ number_format($value, 0, ',', '.') }}"></div>
            <span class="text-xs text-slate-500">{{ $label }}</span>
        </div>
    @endforeach
</div>
