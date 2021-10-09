<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\NoAdjudication;
use App\Models\Power;
use Illuminate\Http\Request;

class StoreGameController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(StoreGameRequest $request)
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

        $game->load('variant');
        $game->variant->basePowers()->each(fn (BasePower $b) => Power::create([
            'base_power_id' => $b->id,
            'game_id' => $game->id,
        ]));

        $game->load('powers');

        /** @var Power $power */
        $power = $game->powers->random();
        $power->update(['user_id' => auth()->user()->id]);

        // TODO: Dispatch job for initializing variant

        return redirect()->route('games.show', ['game' => $game]);

    }
}
