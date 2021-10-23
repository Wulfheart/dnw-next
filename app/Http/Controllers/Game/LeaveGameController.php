<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class LeaveGameController extends Controller
{

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Request $request, Game $game)
    {
        $this->authorize('leave', $game);

        $game->powers()->where('user_id', auth()->user()->id)->update(['user_id' => null]);

        return redirect();
    }
}
