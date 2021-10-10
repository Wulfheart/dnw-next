<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Jobs\InitializeGameJob;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\NoAdjudication;
use App\Models\Power;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StoreGameController extends Controller
{
    public function __invoke(StoreGameRequest $request): RedirectResponse
    {
        $game = Game::create([
            'name' => $request->get('name'),
            'phase_length' => $request->get('phase_length'),
            'variant_id' => $request->get('variant_id'),
        ]);


        // TODO: Test if always accepted
        $game->noAdjudicationDays()->createMany(collect(
            $request->get('no_adjudication'))->keys()->unique()->map(
            fn(int $iso_weekday) => ['iso_weekday' => $iso_weekday]
        )->toArray());

        $game->load('variant.basePowers');
        $game->variant->basePowers()->each(fn (BasePower $b) => Power::create([
            'base_power_id' => $b->id,
            'game_id' => $game->id,
        ]));

        $game->load('powers');
        /** @var Power $power */
        $power = $game->powers->random();
        $power->update(['user_id' => auth()->user()->id]);

        $this->dispatch(new InitializeGameJob($game->id));

        return redirect()->route('games.show', ['game' => $game]);

    }
}
