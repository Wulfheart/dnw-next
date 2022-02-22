<?php

namespace App\Policies;

use App\Enums\GameStatusEnum;
use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    public function join(User $user, Game $game): bool
    {
        return $game->powers()->where('user_id', $user->id)->doesntExist() && $game->currentState() == GameStatusEnum::PREGAME;
    }

    public function leave(User $user, Game $game): bool
    {
        return $game->powers()->where('user_id', $user->id)->exists() && $game->currentState() == GameStatusEnum::PREGAME;
    }

    // public function indexMessages(User $user, Game $game){
    //     $game->loadMissing('powers');
    //     return $game->powers->pluck('user_id')->contains($user->id);
    // }

    public function submitOrders(User $user, Game $game) {
        $game->loadMissing(['powers']);
        return $game->powers->pluck('user_id')->contains($user->id) && $game->currentState() == GameStatusEnum::RUNNING;
    }
}
