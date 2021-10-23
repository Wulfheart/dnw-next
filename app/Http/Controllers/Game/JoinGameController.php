<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class JoinGameController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Request $request, Game $game)
    {
        $this->authorize('join', $game);

        $game->powers()->whereNull('user_id')->inRandomOrder()->first()->update(['user_id' => auth()->user()->id]);

        return redirect()->route('games.show', ['game' => $game]);

    }
}
