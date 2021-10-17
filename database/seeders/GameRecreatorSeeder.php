<?php

namespace Database\Seeders;

use App\Jobs\AdjudicateGameJob;
use App\Jobs\InitializeGameJob;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\Power;
use App\Models\Variant;
use App\Utility\Game\GameRecreator;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class GameRecreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fs = Storage::drive('gameseed');
        $sequence = Http::fakeSequence();
        foreach ($fs->directories() as $directory) {
            $files = $fs->allFiles($directory);
            foreach ($files as $file){
                $sequence->pushFile($fs->path($file));
            }
        }
        foreach ($fs->directories() as $directory) {
            $files = $fs->allFiles($directory);
            var_dump($directory);
            $variant = Variant::first();

            $game = Game::create([
                'name' => faker()->catchPhrase,
                'phase_length' => Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
                'variant_id' => $variant->id,
                'scs_to_win' => $variant->default_scs_to_win,
            ]);

            $game->load('variant.basePowers');
            $game->variant->basePowers()->each(fn (BasePower $b) => Power::create([
                'base_power_id' => $b->id,
                'game_id' => $game->id,
            ]));
            dispatch_sync(new InitializeGameJob($game->id));


            for($i = 0; $i < count($files) - 1; $i++){
                $game->load('currentPhase.phasePowerData.power.basePower');
                dispatch_sync(new AdjudicateGameJob($game->id));
            }

            DB::statement("UPDATE phase_power_data SET orders = applied_orders where phase_id IN (SELECT distinct p.id FROM phase_power_data INNER JOIN phases p on phase_power_data.phase_id = p.id WHERE game_id = $game->id)");

        }
    }
}
