@props(['course'])
@php
    $slug = mb_strtolower($course->category->slug ?? $course->category->name ?? '');
    $webImages = ['category-web.jpg', 'category-web-2.jpg', 'category-web-3.jpg', 'category-web-4.jpg'];
    $fallback = match (true) {
        str_contains($slug, 'database'), str_contains($slug, 'du-lieu'), str_contains($slug, 'co-so') => 'category-database.jpg',
        str_contains($slug, 'network'), str_contains($slug, 'mang') => 'category-network.jpg',
        str_contains($slug, 'security'), str_contains($slug, 'bao-mat'), str_contains($slug, 'an-toan') => 'category-security.jpg',
        str_contains($slug, 'data'), str_contains($slug, 'phan-tich'), str_contains($slug, 'ai') => 'category-data.jpg',
        str_contains($slug, 'process'), str_contains($slug, 'quy-trinh'), str_contains($slug, 'phan-mem') => 'category-process.jpg',
        default => $webImages[((int) $course->id) % count($webImages)],
    };
    $src = $course->thumbnail ? asset('storage/'.$course->thumbnail) : asset('images/lms/'.$fallback);
@endphp
<img src="{{ $src }}" alt="Ảnh khóa học {{ $course->title }}" {{ $attributes->class('h-full w-full object-cover') }}>
