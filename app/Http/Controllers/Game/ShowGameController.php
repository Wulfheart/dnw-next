<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Phase;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ShowGameController extends Controller
{
    public function __invoke(Request $request, Game $game)
    {
        // $this->authorize('view', $game);

        $game->load(['phases', 'powers.basePower', 'winners']);

        $phase_keys = $game->phases->map(fn(Phase $phase) =>
        collect([])
            ->when(!is_null($phase->svg_with_orders), fn(Collection $c) => $c->put($phase->phase_name_short . "_with_orders", $phase))
            ->when(!is_null($phase->svg_adjudicated), fn(Collection $c) => $c->put($phase->phase_name_short . "_adjudicated", $phase))
        )->flatMap(fn($values) => $values);


        return view('game.show', [
            'is_still_creating' => is_null($game->currentPhase),
            'phase_keys' => $phase_keys,
            'game' => $game
        ]);

    }
}
