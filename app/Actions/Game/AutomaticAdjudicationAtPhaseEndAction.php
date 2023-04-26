<?php

namespace App\Actions\Game;

use App\Models\Game;
use Illuminate\Database\Query\Builder;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Bus;
use Lorisleiva\Actions\Concerns\AsAction;

class AutomaticAdjudicationAtPhaseEndAction
{
    public function handle()
    {
        $games = Game::whereCanBeAjdudicated()->get();

        foreach ($games as $game) {
            $game->currentPhase->lockForAdjudication();
            AdjudicateGameAction::dispatch($game->id);
        }
    }
}
