<?php /** @var \App\Models\Game $game */ ?>
@props(['game'])

@switch($game->currentState())
    @case(\App\Enums\GameStatusEnum::PREGAME)
        <x-game.preview.new :game="$game"/>
    @break
    @case(\App\Enums\GameStatusEnum::RUNNING)
        {{ $game->currentState()->name }}
        <x-game.preview.active :game="$game"/>
    @break

@endswitch
