<?php

namespace App\Utility\Game;

use App\Jobs\AdjudicateGameJob;
use App\Jobs\InitializeGameJob;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Models\Variant;
use App\Utility\Game\DTO\DumbbotRequestDTO;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Mock;
use Mockery\MockInterface;
use Symfony\Component\Finder\Finder;
use Tests\TestCase;

class GameRecreator
{
    public function __construct(
        public AdjudicatorService $adjudicator
    )
    {
    }

    function createFromFolder(string $path){
        $files = Storage::drive('gamedata')->allFiles("5ddc2830-fa23-4a0d-9a78-ccb06ccab2bb");
        $variant = Variant::first();

        $game = Game::create([
            'name' => faker()->catchPhrase,
            'phase_length' => Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
            'variant_id' => $variant->id,
            'scs_to_win' => $variant->default_scs_to_win,
        ]);

        $sequence = Http::fakeSequence();
        foreach ($files as $file){
            $sequence->pushFile(Storage::drive('gamedata')->path($file));
        }



        $game->load('variant.basePowers');
        $game->variant->basePowers()->each(fn (BasePower $b) => Power::create([
            'base_power_id' => $b->id,
            'game_id' => $game->id,
        ]));
        dispatch_sync(new InitializeGameJob($game->id, true));


        for($i = 0; $i < count($files) - 1; $i++){
            $game->load('currentPhase.phasePowerData.power.basePower');
            dispatch_sync(new AdjudicateGameJob($game->id, true));
        }

        DB::statement("UPDATE phase_power_data SET orders = applied_orders where phase_id IN (SELECT distinct p.id FROM phase_power_data INNER JOIN phases p on phase_power_data.phase_id = p.id WHERE game_id = $game->id)");
    }

}