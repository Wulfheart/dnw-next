@props(['game'])

<x-game.preview :name="$game->name" :link="route('games.show', $game)"
                :bg="storage_asset($game->currentPhase->svg_adjudicated)">
    <x-slot name="left">
        {{ $game->powers->count() }}/{{$game->variant->basePowers->count()}} Spieler
    </x-slot>
    <x-slot name="right">
        {{ humanize_minutes($game->phase_length) }}
    </x-slot>
</x-game.preview>