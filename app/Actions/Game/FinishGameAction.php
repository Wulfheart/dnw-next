<?php

namespace App\Actions\Game;

use App\Models\Game;
use App\Models\Power;
use App\Notifications\Game\GameFinishedNotification;
use Lorisleiva\Actions\Concerns\AsAction;

class FinishGameAction
{

    /**
     * @param  array<string>  $winners
     */
    public function handle(Game $game, array $winners, bool $send_email = true): void
    {
        $game->loadMissing('powers.basePower');

        $game->powers->filter(
            fn(Power $p) => collect($winners)->contains($p->basePower->api_name)
        )->each(fn(Power $p) => $p->update(['is_winner' => true]));

        if($send_email) {
            $game->powers->each(
                fn(Power $power) => $power->loadMissing('user')->user->notify(new GameFinishedNotification($game))
            );
        }
    }
}
