<x-app-layout>

    <x-container.index>

        <x-tabs>
            <a href="{{ route('games.index', ['type' => 'player']) }}"><x-tabs.item :active="$tab == 'player'">Meine Spiele</x-tabs.item></a>
            <a href="{{ route('games.index', ['type' => 'new']) }}"><x-tabs.item :active="$tab == 'new'">Neu</x-tabs.item></a>
            <a href="{{ route('games.index', ['type' => 'active']) }}"><x-tabs.item :active="$tab == 'active'">Aktiv</x-tabs.item></a>
            <a href="{{ route('games.index', ['type' => 'finished']) }}"><x-tabs.item :active="$tab == 'finished'">Beendet</x-tabs.item></a>
        </x-tabs>
        <?php /** @var \App\Models\Game $game */ ?>
        @forelse($games as $game)
            <div>{{ $game->name }}</div>
        @empty

        @endforelse
    </x-container.index>
</x-app-layout>