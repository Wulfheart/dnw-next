<x-game.header :game="$game" :adjudication-in-progress="$adjudicationInProgress" :has-started="$hasStarted">
    <div class="mt-5">
        <livewire:game.messages :power_id="19" :message-room-id="$messageRoom->id"></livewire:game.messages>
    </div>
</x-game.header>