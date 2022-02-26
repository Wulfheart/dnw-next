<?php

namespace App\Actions\Game;

use App\Events\Game\GameStartedEvent;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Response;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;

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

        if($game->powers->whereUserAssigned()->count() == $game->powers->count()){
            StartGameAction::run($game);
        }
    }
}
