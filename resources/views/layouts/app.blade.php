<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name', 'Laravel') }} @isset($currentCompany) - {{ $currentCompany->name }} @endisset</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50">
    @php
        $currentCompany = auth()->user()->currentCompany ?? null;
    @endphp

    <div class="min-h-screen flex flex-col">
        {{-- Navigation --}}
        <x-navigation-menu :company="$currentCompany" />

        {{-- Page Content --}}
        <main class="flex-1">
            {{ $slot }}
        </main>

        {{-- Optional Footer --}}
        <footer class="text-center text-sm text-gray-500 py-4">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </footer>
    </div>

    @livewireScripts
</body>
</html>