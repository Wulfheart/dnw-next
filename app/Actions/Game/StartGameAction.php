<?php

namespace App\Actions\Game;

use App\Models\Game;
use Lorisleiva\Actions\Concerns\AsAction;

class StartGameAction
{
    use AsAction;

    public function handle(Game $game){
        $game->loadMissing('currentPhase');

        $game->currentPhase->update(['adjudication_at' => $game->calculateNextAdjudicationPhaseEnd()]);
    }
}