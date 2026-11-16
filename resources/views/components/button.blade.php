@props(['variant'=>'primary','type'=>'submit','size'=>'md','loading'=>false])
@php
    $v = ['primary'=>'bg-primary-700 text-white hover:bg-primary-800 focus-visible:ring-primary-500','secondary'=>'border border-slate-300 bg-white text-slate-700 hover:border-slate-400','danger'=>'bg-red-700 text-white hover:bg-red-800 focus-visible:ring-red-500','ghost'=>'text-slate-700 hover:text-slate-950'][$variant] ?? 'bg-primary-700 text-white hover:bg-primary-800';
    $z = ['sm'=>'px-3 py-1.5 text-xs','md'=>'px-4 py-2.5 text-sm','lg'=>'px-5 py-3 text-base'][$size] ?? 'px-4 py-2.5 text-sm';
@endphp
<button type="{{ $type }}" {{ $attributes->class(['inline-flex items-center justify-center gap-2 rounded-md font-semibold transition-colors disabled:pointer-events-none disabled:opacity-50',$v,$z]) }}>@if($loading)<svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 0 1 8-8v4a4 4 0 0 0-4 4H4Z"/></svg>@endif<span>{{ $slot }}</span></button>
