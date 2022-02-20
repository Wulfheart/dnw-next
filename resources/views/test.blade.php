{{--<x-app-layout>--}}
{{--    <x-game.countdown :iso-datetime="now()->addSeconds(30)->toIso8601String()"/>--}}

{{--</x-app-layout>--}}

<!doctype html>
<html lang="en">
<head>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div x-init="$interval(() => console.log('Hello World'), 1000)"></div>
@livewireScripts
</body>
</html>


