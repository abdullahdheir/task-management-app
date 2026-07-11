<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}"x-data="{
    darkMode: {{ auth()->check() ? (auth()->user()->dark_mode ? 'true' : 'false') : "window.matchMedia('(prefers-color-scheme: dark)').matches" }}
}"
    :class="{ 'dark': darkMode, 'light': !darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title', 'Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Geist:ital,wght@0,100..900;1,100..900&family=Inter:wght@100..900&family=Source+Serif+4:ital,opsz,wght@0,8..18,200..900;1,8..18,200..900&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css'])

    <style>
        body {
            font-family: 'Geist', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .card-elevation {
            box-shadow: 0px 4px 6px -1px rgba(0, 0, 0, 0.05), 0px 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        input[type="checkbox"] {
            cursor: pointer;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-background text-on-background min-h-screen flex">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    {{-- Main Canvas --}}
    <main class="md:ml-64 flex-1">

        {{-- Top Nav --}}
        @include('partials.topnav')

        {{-- Page Content --}}
        <div class="p-gutter-desktop max-w-container-max mx-auto">
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed top-4 right-4 z-[999] bg-secondary-container text-on-secondary-fixed-variant
                            px-6 py-3 rounded-xl shadow-lg font-label-md text-label-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed top-4 right-4 z-[999] bg-error-container text-on-error-container
                            px-6 py-3 rounded-xl shadow-lg font-label-md text-label-md">
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
            <!-- Footer Space -->
            <footer class="mt-20 py-10 border-t border-outline-variant text-center">
                <p class="text-label-sm font-label-sm text-on-surface-variant">© 2024
                    {{ strtolower(config('app.name')) }} Productivity Inc. All rights
                    reserved.</p>
            </footer>
        </div>
        {{-- Bottom Nav --}}
        @include('partials.bottomnav')
    </main>

    @stack('scripts')
    @vite(['resources/js/app.js'])
</body>

</html>
