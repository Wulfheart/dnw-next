<?php

use App\Actions\Game\RememberUsersToOrderAction;
use App\Models\PhasePowerData;
use App\Notifications\Game\NoOrderReceivedYetNotification;

it('remembers a user to submit orders', function () {
    Notification::fake();

    $game = setupGame();

    $game->loadMissing('currentPhase.phasePowerData');

    $game->currentPhase->adjudication_at = now()->addMinutes(20);
    $game->currentPhase->save();


    $game->currentPhase->phasePowerData->first()->update([
        'orders' => 'foo',
    ]);

    RememberUsersToOrderAction::run();

    $game->load('currentPhase.phasePowerData.power.user');

    $game->currentPhase->phasePowerData->loadMissing('power.user');

    $users = $game->currentPhase->phasePowerData->slice(1)->pluck('power.user');

    Notification::assertSentTo($users, NoOrderReceivedYetNotification::class);


});