<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class CreateGameController extends Controller
{
    public function __invoke(Request $request)
    {
        $phaselengths = collect([
            5, 10, 15, 20, 30, 60, 120, 240, 360, 480, 600, 720, 840, 960, 1080, 1200, 1320, 1440, 2160, 2880, 4320, 5760, 7200, 8640, 10080, 14400,
        ])->map(
            fn (int $elem) => ['minutes' => $elem, 'humanized' => CarbonInterval::minutes($elem)->cascade()->forHumans()]
        )->toArray();

        $noAdjudicationDays = collect([1, 2, 3, 4, 5, 6, 7])->map(
            fn (int $elem) => [
                'iso_weekday' => $elem,
                'humanized' => now()->isoWeekday($elem)->dayName,
                'form_key' => "no_adjudication[$elem]",
            ]
        )->toArray();

        return view('game.create', [
            'variants' => Variant::all(),
            'phaselengths' => $phaselengths,
            'default_phaselength' => 1440,
            'no_adjudication_days' => $noAdjudicationDays,
        ]);
    }
}
