<?php /** @var \App\Models\Game $game */ ?>
@props(['game'])

<x-game.preview :name="$game->name" :link="route('games.show', $game)"
    :bg="storage_asset($game->currentPhase->svg_adjudicated)">
    <x-slot name="left">
        {{ $game->powers->whereUserAssigned()->count() }}/{{ $game->powers->count() }} Spieler
    </x-slot>
    <x-slot name="right">
        {{ humanize_minutes($game->phase_length) }}
    </x-slot>
</x-game.preview>
