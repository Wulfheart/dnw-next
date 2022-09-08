<?php

namespace App\Policies;

use App\Enums\GameStatusEnum;
use App\Models\Game;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return true;
    }

    public function join(User $user, Game $game): bool
    {
        return $game->powers()->where('user_id', $user->id)->doesntExist() && $game->currentState() == GameStatusEnum::PREGAME;
    }

    public function leave(User $user, Game $game): bool
    {
        return $game->powers()->where('user_id', $user->id)->exists() && $game->currentState() == GameStatusEnum::PREGAME;
    }

    public function indexMessages(User $user, Game $game){
        $game->loadMissing('powers');
        return $game->powers->pluck('user_id')->contains($user->id) && $game->hasStarted();
    }

    public function submitOrders(User $user, Game $game) {
        $game->loadMissing(['powers', 'phasePowerData', 'currentPhase']);

        /** @var Power $userPower */
        $userPower = $game->powers->filter(fn(Power $p) => $p->user_id == $user->id)->first();

        if($userPower == null){
            return false;
        }

        if($game->currentPhase->adjudicationStarted()){
            return false;
        }

        /** @var PhasePowerData $phasePowerData */
        $phasePowerData = $game->phasePowerData->first(fn(PhasePowerData $ppd) => $ppd->power_id == $userPower->id);

        return $phasePowerData->orders_needed && $game->currentState() == GameStatusEnum::RUNNING;
    }
}
