<?php

use App\Actions\Game\RememberUsersToOrderAction;
use App\Models\PhasePowerData;
use App\Notifications\Game\NoOrderReceivedYetNotification;

it('', function () {
    Queue::fake();
    Notification::fake();

    $game = setupGame();

    $game->loadMissing('currentPhase.phasePowerData');

    $game->currentPhase->adjudication_at = now()->addMinutes(20);
    $game->currentPhase->save();


    $game->currentPhase->phasePowerData->first()->update([
        'orders' => 'foo',
    ]);

    RememberUsersToOrderAction::run();

    $game->currentPhase->phasePowerData->loadMissing('power.user');

    $game->currentPhase->phasePowerData->slice(1)->each(function (PhasePowerData $phasePowerData) {
        Notification::assertSentTo($phasePowerData->power->user, NoOrderReceivedYetNotification::class);
    });


});