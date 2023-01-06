<?php

namespace App\Actions\Game;

use App\Models\Game;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class JoinGameAction
{
    use AsAction;

    public function handle(User $user, Game $game): void
    {
        $game->powers()
            ->whereNull('user_id')
            ->inRandomOrder()
            ->firstOrFail()
            ->update(['user_id' => $user->id]);

        $game->load('powers');

        if ($game->powers->whereUserAssigned()->count() == $game->powers->count()) {
            StartGameAction::run($game);
        }
    }
}
