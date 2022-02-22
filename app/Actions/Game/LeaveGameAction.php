<?php

namespace App\Actions\Game;

use App\Models\Game;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class LeaveGameAction
{
    use AsAction;

    public function handle(User $user, Game $game): void
    {
        $game->powers()
            ->where('user_id', $user->id)
            ->update(['user_id' => null]);
    }
}
