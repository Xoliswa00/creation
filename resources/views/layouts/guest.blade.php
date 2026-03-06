<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen flex flex-col justify-center items-center bg-gray-50">

    @php
        $inviteCompany = session('invite_company_name') ?? null;
    @endphp

    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        @if($inviteCompany)
            <div class="mb-4 text-center text-gray-700 font-medium text-lg">
                Welcome to {{ $inviteCompany }}!
            </div>
        @else
            <div class="mb-4 text-center text-gray-700 font-medium text-lg">
                Welcome to {{ config('app.name') }}!
            </div>
        @endif

        {{-- Slot for login/register forms --}}
        {{ $slot }}

        <div class="mt-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>

    @livewireScripts
</body>
</html>