<x-app-layout>
    <x-game.countdown :isoDatetime="now()->addSeconds(30)->toIso8601String()" />

</x-app-layout>
