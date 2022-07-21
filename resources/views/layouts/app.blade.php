<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

    </style>

    @stack('head')

    @livewireStyles

</head>

<body class="font-sans antialiased scroll-smooth {{ config('app.debug') ? 'debug-screens' : '' }}">
    <x-jet-banner />

    <div class="min-h-screen">
        <div class="shadow">

            @livewire('navigation-menu')
        </div>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
    @if(config('app.debug'))
        <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/toolbar.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/underground-works/clockwork-browser@1/dist/metrics.js"></script>
    @endif
</body>
</html>
