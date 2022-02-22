<?php

namespace App\Http\Controllers\Game;

use App\Actions\Game\LeaveGameAction;
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

        LeaveGameAction::run(auth()->user(), $game);

        return redirect()->route('games.index');
    }
}
