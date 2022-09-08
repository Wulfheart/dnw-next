<x-game.header :game="$game" :adjudication-in-progress="$adjudicationInProgress" :has-started="$hasStarted">
    <div class="mt-5">
        <livewire:game.message-room-overview :power_id="$power_id" :game_id="$game->id"/>
    </div>
</x-game.header>