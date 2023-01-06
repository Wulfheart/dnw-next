<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\ViewModels\Game\IndexGameViewModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class IndexGameController extends Controller
{
    public function __invoke(Request $request)
    {
        /**
         * @return array<Game>|\Illuminate\Database\Eloquent\Collection
         */
        $retrieve = fn (Builder $builder) => $builder->with([
            'currentPhase.phasePowerData.power.basePower',
            'powers',
            'variant.basePowers',
            'winners',
        ])->get();

        $vm = new IndexGameViewModel(
            $retrieve(Game::whereActive()->limit(4)),
            $retrieve(Game::whereNew()->limit(3)),
            $retrieve(Game::whereUserIsMember(auth()->user())->limit(4)),
            $retrieve(Game::whereFinished()->limit(4)),
            Game::whereNew()->count() > 3,
            Game::whereUserIsMember(auth()->user())->count() > 4,
            Game::whereFinished()->count() > 4,
            Game::whereActive()->count() > 4,
        );

        return view('game.index', ['vm' => $vm]);
    }
}
