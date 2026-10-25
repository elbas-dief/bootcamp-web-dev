<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800 antialiased">

<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto">
        <div class="flex item-center justify-between px-4 sm:px-6 lg-px-8">
            <a href="{{route('product-controller.index')}}">Product Controller</a>
            <a href="{{route('product-controller.show', 1)}}">Product Controller Show 1</a>
        </div>
    </div>
</nav>

    <nav class="border-b border-slate-200 bg-white/90 shadow-sm backdrop-blur-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
            <a href="{{ url('/') }}" class="text-xl font-bold tracking-tight text-indigo-600">
                LaravelApp
            </a>

            <div class="hidden items-center gap-6 md:flex">
                <a href="{{ url('/') }}" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">
                    Home
                </a>
                <a href="{{ url('/hello') }}" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">
                    Hello
                </a>
                <a href="{{ url('/about') }}" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">
                    About
                </a>
                <a href="{{ url('/product-controller') }}" class="text-sm font-medium text-slate-600 transition hover:text-indigo-600">
                    Products
                </a>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/hello') }}" class="hidden rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition hover:border-indigo-200 hover:text-indigo-600 sm:inline-flex">
                    Login
                </a>
                <a href="{{ url('/product-controller') }}" class="inline-flex rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500">
                    Get Started
                </a>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    @yield('content')
</body>

</html>