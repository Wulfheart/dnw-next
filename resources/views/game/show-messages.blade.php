<x-game.header :game="$game" :adjudication-in-progress="$adjudicationInProgress" :has-started="$hasStarted">
    <div class="mt-5">
        <livewire:game.message-room-overview :power_id="2"/>
    </div>
</x-game.header>