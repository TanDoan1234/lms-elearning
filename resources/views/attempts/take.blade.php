<x-app-layout>
    <x-slot name="header"><h1 class="text-xl font-semibold">{{ $attempt->exam->title }}</h1></x-slot>
    <div class="mx-auto max-w-7xl px-4 py-8"><livewire:exam.take-exam :attempt="$attempt" /></div>
</x-app-layout>
