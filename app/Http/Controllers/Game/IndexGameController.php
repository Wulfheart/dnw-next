<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class IndexGameController extends Controller
{
    public function __invoke(Request $request)
    {
        $preview = collect([
            'player' => Game::whereUserIsMember(auth()->user()),
            'new' => Game::whereNew()->with([
                'powers' => fn($b) => $b->whereNotNull('user_id'),
                'variant.basePowers'
            ]),
            'finished' => Game::whereFinished(),
            'active' => Game::whereActive()
        ])->map(fn(Builder $builder) =>
            $builder->with(['currentPhase.phasePowerData.power.basePower'])->limit(5)->get()
        );

        return view('game.index', [
            'preview' => $preview,
        ]);
    }
}