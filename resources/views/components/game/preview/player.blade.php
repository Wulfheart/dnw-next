@props(['game'])

<x-game.preview :name="$game->name" :link="route('games.show', $game)"
    :bg="storage_asset($game->currentPhase->svg_adjudicated)">
    <x-slot name="left">

    </x-slot>
    <x-slot name="right">

    </x-slot>
</x-game.preview>
