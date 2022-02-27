<?php

namespace App\Actions\Game;

use App\Models\Game;
use Illuminate\Database\Query\Builder;
use Lorisleiva\Actions\Concerns\AsAction;

class AutomaticAdjudicationAtPhaseEndAction
{
    use AsAction;

    public function handle()
    {
        $games = Game::whereCanBeAjdudicated()->get();

        foreach ($games as $game) {
            $game->currentPhase->lockForAdjudication();
            AdjudicateGameAction::dispatch($game->id);
        }
    }
}
