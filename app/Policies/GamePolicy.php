<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Game $game)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Game $game)
    {
        //
    }


    public function delete(User $user, Game $game)
    {
        //
    }

    public function join(User $user, Game $game): bool
    {
        return $game->powers()->where('user_id', $user->id)->doesntExist() && $game->powers()->whereNull('user_id')->exists();
    }

    public function leave(User $user, Game $game): bool
    {
        return $game->powers()->whereNull('user_id')->exists();
    }

    public function indexMessages(User $user, Game $game){
        return $game->powers()->where('user_id', $user->id)->exists();
    }
}
