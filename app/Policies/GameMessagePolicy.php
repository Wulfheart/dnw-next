<?php

namespace App\Policies;

use App\Models\Game;
use App\Models\MessageRoom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GameMessagePolicy
{
    use HandlesAuthorization;

    public function view(User $user, MessageRoom $messageRoom){
        $messageRoom->loadMissing('powers');
        return $messageRoom->powers->pluck('user_id')->contains($user->id);
    }
}
