<?php

namespace App\Actions\Game\Fake;

use App\Models\Game;
use Lorisleiva\Actions\Concerns\AsAction;

class FakeOrdersAction
{
    use AsAction;

    public string $commandSignature = 'dnw:game:fake-orders {--id=} {--ready}';

    public function handle(Game $game, bool $ready)
    {
        $game->loadMissing('currentPhase.phasePowerData.power');

        foreach ($game->currentPhase->phasePowerData as $ppd) {
            if (isset($ppd->orders)) {
                continue;
            }

            $ppd->update([
                'ready_for_adjudication' => $ready,
                'orders' => '',
            ]);
        }
    }

    public function asCommand(\Illuminate\Console\Command $command): void
    {
        $ready = $command->option('ready');

        $game_id = $command->option('id');
        /** @var Game $game */
        $game = Game::with('currentPhase')->findOrFail($game_id);

        if($game->currentPhase->adjudicationStarted()){
            $command->error("Adjudication already in progress. Aborting.");
            return;
        }
        $this->handle($game, $ready);
    }
}
