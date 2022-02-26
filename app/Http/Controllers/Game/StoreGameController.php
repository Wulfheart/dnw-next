<?php

namespace App\Http\Controllers\Game;

use App\Actions\Game\CreateGameAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Models\Game;
use Illuminate\Http\Request;

class StoreGameController extends Controller
{

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke(StoreGameRequest $request)
    {
        $this->authorize('create', Game::class);
        $game = CreateGameAction::run($request->user(), $request->get('name'), $request->get('phase_length'), $request->get('variant_id'), $request->get('no_adjudication') ?? [], false);
        return redirect()->route('games.show', ['game' => $game]);
    }
}
