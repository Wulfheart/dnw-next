@props(['game'])

<x-game.preview :link="route('games.show', $game)" :show_notification="$game->hasUnreadMessagesForUserId(auth()->id())"
    :bg="storage_asset($game->currentPhase->svg_adjudicated)" class="relative">
    <x-slot name="name">
            <x-heroicon-s-envelope class="inline-block mb-1 w-5 h-5 text-white"></x-heroicon-s-envelope>
            {{$game->name}}
    </x-slot>
    <x-slot name="left">
        {{ $game->currentPhase->phase_name_short }}
    </x-slot>
    <x-slot name="right">
        @if($game->currentPhase->adjudicationStarted())
            Auswertung läuft
        @else
            <x-game.countdown :isoDatetime="$game->currentPhase->adjudication_at?->toIso8601String()" />
        @endif
    </x-slot>
</x-game.preview>
