<!DOCTYPE html><html lang="{{ str_replace('_', '-', app()->getLocale()) }}"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="csrf-token" content="{{ csrf_token() }}"><title>{{ $title ?? config('app.name', 'LMS E-Learning') }}</title>
<link rel="preconnect" href="https://fonts.bunny.net"><link href="https://fonts.bunny.net/css?family=be-vietnam-pro:400,500,600,700&display=swap" rel="stylesheet">@vite(['resources/css/app.css','resources/js/app.js']) @livewireStyles @stack('styles')</head>
<body class="font-sans antialiased"><div class="flex min-h-screen flex-col bg-slate-50">@include('partials.nav') <x-flash />
@isset($header)<header class="border-b border-slate-200 bg-white"><div class="page-container py-6 sm:py-8">{{ $header }}</div></header>@endisset
<main class="flex-1">{{ $slot }}</main>@include('partials.footer')</div>@livewireScriptConfig @stack('scripts')</body></html>
