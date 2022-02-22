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
            'player' => Game::whereUserIsMember(auth()->user())->limit(4),
            'new' => Game::whereNew()->limit(3),
            'finished' => Game::whereFinished()->limit(4)->with('winners'),
            'active' => Game::whereActive()->limit(4),
        ])->map(fn(Builder $builder) =>
            $builder->with([
                'currentPhase.phasePowerData.power.basePower',
                'powers' => fn($b) => $b->whereNotNull('user_id'),
                'variant.basePowers'
            ])->get()
        );

        return view('game.index', [
            'preview' => $preview,
            'show' => new class {
                public bool $new = true;
            },
            't' => (object) [
                'new' => true
            ]
        ]);
    }
}