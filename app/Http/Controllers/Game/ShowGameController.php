<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class ShowGameController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Request $request, Game $game)
    {
        // $this->authorize('view', $game);

        $game->load(['currentPhase.phasePowerData', 'powers.basePower', 'winners']);

        return view('game.show');
        if($game->currentPhase == null){

        } else {

        }
    }
}
