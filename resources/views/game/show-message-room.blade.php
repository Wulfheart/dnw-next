<x-game.header :game="$game" :adjudication-in-progress="$adjudicationInProgress" :has-started="$hasStarted">
    <div class="space-y-5 mt-5">
        <livewire:game.submit-message :power-id="$power_id" :message-room-id="$messageRoom->id"/>
        <livewire:game.messages :power_id="$power_id" :message-room-id="$messageRoom->id"></livewire:game.messages>
    </div>
</x-game.header>