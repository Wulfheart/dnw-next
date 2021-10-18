<?php

namespace App\Http\Controllers\Game;

use App\DTO\Views\PhaseDTO;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Phase;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class ShowGameController extends Controller
{
    public function __invoke(Request $request, Game $game)
    {
        // $this->authorize('view', $game);

        $game->load([
            'powers.basePower', 'winners', 'phases' => function ($query) {
                $query->select(collect(Schema::getColumnListing(app(Phase::class)->getTable()))->reject(fn(string $v
                ) => $v === 'state_encoded')->toArray());
            },
        ]);

        $phases = $game->phases->map(fn(Phase $phase) => collect()
            ->when(!is_null($phase->svg_with_orders), fn(Collection $c) => $c->put($phase->phase_name_short."_with_orders",
                PhaseDTO::factory()->setKey($phase->phase_name_short."_with_orders")->setSvg($phase->svg_with_orders)
                )
            )
            ->when(!is_null($phase->svg_adjudicated), fn(Collection $c) => $c->put($phase->phase_name_short."_adjudicated",
                PhaseDTO::factory()->setKey($phase->phase_name_short."_adjudicated")->setSvg($phase->svg_adjudicated)
                )
            )

        )->flatMap(fn($values) => $values);



        return view('game.show', [
            'is_still_creating' => is_null($game->currentPhase),
            'phases' => $phases,
            'phase_keys' => $phases->keys(),
            'game' => $game,
        ]);

    }
}
