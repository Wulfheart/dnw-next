<x-app-layout>
    <x-game.countdown :isoDatetime="now()->addSeconds(30)->toIso8601String()" />
    <div class="white px-4 sm:px-8 py-2 sm:py-3 bg-sky-700 hover:bg-sky-800">
    </div>
</x-app-layout>
