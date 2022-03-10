<?php

namespace App\Actions\Game;

use App\Models\Game;
use App\Notifications\Game\GameStartedNotification;
use Lorisleiva\Actions\Concerns\AsAction;

class StartGameAction
{
    use AsAction;

    public function handle(Game $game)
    {
        $game->loadMissing('currentPhase');

        $game->currentPhase->update(['adjudication_at' => $game->calculateNextAdjudicationPhaseEnd()]);

        $game->loadMissing('powers.user');
        foreach ($game->powers as $power) {
            $power->user->notify((new GameStartedNotification($game)));
        }
    }
}