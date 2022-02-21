@props(['game'])

<x-game.preview :name="$game->name" :link="route('games.show', $game)"
    :bg="storage_asset($game->currentPhase->svg_adjudicated)">
    <x-slot name="left">
        {{ $game->currentPhase->phase_name_short }}
    </x-slot>
    <x-slot name="right">
        <x-game.countdown :isoDatetime="$game->currentPhase->adjudication_at?->toIso8601String()" />
    </x-slot>
</x-game.preview>
