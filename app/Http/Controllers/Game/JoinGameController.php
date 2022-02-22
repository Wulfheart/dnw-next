<?php

namespace App\Http\Controllers\Game;

use App\Actions\Game\JoinGameAction;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class JoinGameController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Request $request, Game $game)
    {
        $this->authorize('join', $game);

        JoinGameAction::run(auth()->user(), $game);

        return redirect()->route('games.show', $game);

    }
}
