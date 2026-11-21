<!DOCTYPE html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="csrf-token" content="{{ csrf_token() }}"><title>{{ config('app.name','LMS E-Learning') }}</title><link rel="preconnect" href="https://fonts.bunny.net"><link href="https://fonts.bunny.net/css?family=be-vietnam-pro:400,500,600,700&display=swap" rel="stylesheet">@vite(['resources/css/app.css','resources/js/app.js']) @livewireStyles @stack('styles')</head>
<body class="font-sans antialiased" x-data="{ sidebar:false }"><div class="min-h-screen bg-slate-50"><div x-cloak x-show="sidebar" @click="sidebar=false" class="fixed inset-0 z-40 bg-slate-500/30 lg:hidden"></div>
<aside :class="sidebar?'translate-x-0':'-translate-x-full'" class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-slate-200 bg-white text-slate-700 transition lg:translate-x-0">
    <div class="flex h-16 items-center justify-between border-b border-slate-200 px-5"><a href="{{ route('home') }}" class="flex items-center gap-3 font-bold text-slate-950"><x-application-logo class="h-9 w-9"/>LMS E-Learning</a><button @click="sidebar=false" class="rounded p-1 text-slate-500 lg:hidden" aria-label="Đóng điều hướng">×</button></div>
    <nav class="flex-1 space-y-1 overflow-y-auto p-4 text-sm">
        @php
            $links = auth()->user()->isAdmin()
                ? [
                    ['admin.dashboard','Tổng quan',request()->routeIs('admin.dashboard')],
                    ['admin.users.index','Người dùng',request()->routeIs('admin.users.*')],
                    ['admin.categories.index','Danh mục',request()->routeIs('admin.categories.*')],
                    ['admin.courses.index','Khóa học',request()->routeIs('admin.courses.*')],
                    ['admin.orders.index','Đơn hàng',request()->routeIs('admin.orders.*')],
                ]
                : [
                    ['instructor.dashboard','Tổng quan',request()->routeIs('instructor.dashboard')],
                    ['instructor.courses.index','Khóa học của tôi',request()->routeIs('instructor.courses.*','instructor.sections.*','instructor.lessons.*','instructor.exams.*','instructor.questions.*')],
                ];
        @endphp
        @foreach($links as [$route,$label,$active]) @if(Route::has($route))
            <a href="{{ route($route) }}" class="relative flex items-center rounded-md px-4 py-2.5 font-medium {{ $active ? 'bg-primary-50 text-primary-700 before:absolute before:inset-y-1 before:left-0 before:w-[3px] before:rounded-r before:bg-primary-600' : 'text-slate-600 hover:text-slate-900' }}">{{ $label }}</a>
        @endif @endforeach
    </nav>
    <div class="border-t border-slate-200 p-4"><a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-md p-2 text-slate-700 hover:text-slate-950"><span class="grid h-9 w-9 place-items-center rounded-full bg-primary-100 font-bold text-primary-700">{{ mb_strtoupper(mb_substr(auth()->user()->name,0,1)) }}</span><span class="min-w-0"><span class="block truncate text-sm font-semibold text-slate-900">{{ auth()->user()->name }}</span><span class="block truncate text-xs text-slate-500">{{ auth()->user()->email }}</span></span></a></div>
</aside>
<div class="lg:pl-72"><header class="sticky top-0 z-30 flex h-16 items-center border-b border-slate-200 bg-white px-4 sm:px-6"><button @click="sidebar=true" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 lg:hidden" aria-label="Mở thanh điều hướng">☰</button><span class="ml-3 text-sm text-slate-500 lg:ml-0">Không gian {{ auth()->user()->isAdmin() ? 'quản trị' : 'giảng viên' }}</span><a href="{{ route('home') }}" class="ml-auto text-sm font-semibold text-primary-700">Xem trang chủ</a></header><main class="p-4 sm:p-6 lg:p-8"><x-flash/><div class="mx-auto max-w-7xl">@yield('content'){{ $slot ?? '' }}</div></main></div></div>@livewireScriptConfig @stack('scripts')</body></html>
