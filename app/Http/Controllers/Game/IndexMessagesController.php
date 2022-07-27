<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IndexMessagesController extends Controller
{
    public function __invoke(Request $request, Game $game)
    {


        $game->loadMissing('currentPhase');
        return view('game.show-messages', [
            'game' => $game,
            'adjudicationInProgress' => $game->currentPhase->adjudicationStarted(),
            'hasStarted' => $game->hasStarted(),
        ]);
    }
}
