<?php

namespace Database\Seeders;

use App\Actions\Game\AdjudicateGameAction;
use App\Actions\Game\InitializeGameAction;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\Power;
use App\Models\User;
use App\Models\Variant;
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
        $directories = $fs->directories();
        $sequence = Http::fakeSequence();
        $directories = ['9fe65a07-4a5c-4f7d-b3a0-8ce9cf932d80', 'f5874989-5a56-46b8-a8a0-80d7fa032c0c'];
        foreach ($directories as $directory) {
            $files = $fs->allFiles($directory);
            $files = collect($files)->sortBy(fn(string $f) => $f, SORT_NATURAL)->toArray();
            foreach ($files as $file) {
                $sequence->pushFile($fs->path($file));
            }
        }
        foreach ($directories as $directory) {
            $files = $fs->allFiles($directory);
            $file_count = count($files);
            $basetime = now();
            var_dump($directory);
            $variant = Variant::first();

            $game = Game::create([
                'name' => faker()->catchPhrase,
                'phase_length' => Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
                'variant_id' => $variant->id,
                'scs_to_win' => $variant->default_scs_to_win,
            ]);

            $game->load('variant.basePowers');
            $game->variant->basePowers()->each(fn(BasePower $b) => Power::create([
                'base_power_id' => $b->id,
                'game_id' => $game->id,
                'user_id' => User::factory()->create()->id,
            ]));
            InitializeGameAction::run($game->id, false);
            $game->currentPhase()->update(['created_at' => $basetime->subDays($file_count)]);


            for ($i = 0; $i < $file_count - 1; $i++) {
                AdjudicateGameAction::run($game->id, false, false);
                $game->currentPhase()->update(['created_at' => $basetime->subDays($file_count - $i)]);

            }

            DB::statement("UPDATE phase_power_data SET orders = applied_orders where phase_id IN (SELECT distinct p.id FROM phase_power_data INNER JOIN phases p on phase_power_data.phase_id = p.id WHERE game_id = $game->id)");

        }
    }
}
