<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\MessageRoom;
use Illuminate\Http\Request;

class ShowMessagesController extends Controller
{
    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(Request $request, Game $game, MessageRoom $messageRoom)
    {
        $this->authorize('use', $messageRoom);
        $game->loadMissing(['currentPhase', 'powers']);

        return view('game.show-message-room', [
            'game' => $game,
            'adjudicationInProgress' => $game->currentPhase->adjudicationStarted(),
            'hasStarted' => $game->hasStarted(),
            'messageRoom' => $messageRoom,
            'power_id' => $game->powers->firstWhere('user_id', $request->user()->id)->id,
        ]);
    }
}
