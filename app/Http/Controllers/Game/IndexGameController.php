<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndexGameController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var \Illuminate\Database\Eloquent\Builder $gameQuery */
        [$tab, $gameQuery] = match((string) Str::of($request->get('type'))->lower()){
            'player'=> ['player', Game::whereUserIsMember(auth()->user())],
            'new' => ['new', Game::whereNew()],
            'finished' => ['finished', Game::whereFinished()],
            // active
            default => ['active', Game::whereActive()]
        };
        $games = $gameQuery->with('currentPhase.phasePowerData.power.basePower')->paginate(10);

        return view('game.index', [
            'games' => $games,
            'tab' => $tab,
        ]);
    }
}
