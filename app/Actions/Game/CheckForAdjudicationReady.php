<?php

namespace App\Actions\Game;

use App\Models\Game;
use App\Models\PhasePowerData;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckForAdjudicationReady
{
    public function handle(Game $game)
    {
        $game->loadMissing(['currentPhase.phasePowerData.power']);

        $ready_count = $game->currentPhase
            ->phasePowerData
            ->filter(fn(PhasePowerData $ppd) => $ppd->ready_for_adjudication)
            ->count();

        $not_defeated_count = $game->currentPhase->phasePowerData->filter(
            fn(PhasePowerData $ppd) => !$ppd->power->is_defeated
        )->count();
        if($ready_count == $not_defeated_count){
            AdjudicateGameAction::dispatchIf(!$game->currentPhase->adjudicationStarted(), $game->id);
            $game->currentPhase->lockForAdjudication();

        }
    }
}
