<?php

namespace Database\Seeders;

use App\Actions\Game\AdjudicateGameAction;
use App\Actions\Game\InitializeGameAction;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\MessageMode;
use App\Models\Power;
use App\Models\User;
use App\Models\Variant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class GameRecreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = [
            ['name' => 'fullgame.dnw', 'turns' => 13],
        ];

        $base_path = __DIR__.'/games/';

        foreach ($files as $file) {
            $path = $base_path.$file['name'];

            $csv = Reader::createFromPath($path);

            $csv->setHeaderOffset(0);

            $basetime = now();
            $count = $file['turns'];
            $variant = Variant::firstOrFail();
            $messageMode = MessageMode::firstOrFail();

            $game = Game::create([
                'name' => faker()->catchPhrase,
                'phase_length' => Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
                'variant_id' => $variant->id,
                'message_mode_id' => $messageMode->id,
                'scs_to_win' => $variant->default_scs_to_win,
            ]);

            $game->load('variant.basePowers');
            $game->variant->basePowers()->each(fn(BasePower $b) => Power::create([
                'base_power_id' => $b->id,
                'game_id' => $game->id,
                'user_id' => User::factory()->create()->id,
            ]));
            InitializeGameAction::run($game->id, false);
            $all = collect($csv->getRecords())
                ->groupBy('turn')
                ->map(fn($c) => $c->groupBy('country'));
            foreach ($all as $turn) {
                foreach ($turn as $power) {
                    foreach ($power as $order) {
                        
                    }
                }
            }
            // $files = $fs->allFiles($directory);
            // $game->currentPhase()->update(['created_at' => $basetime->subDays($file_count)]);
            //
            //
            // for ($i = 0; $i < $file_count - 1; $i++) {
            //     AdjudicateGameAction::run($game->id, false, false);
            //     $game->currentPhase()->update(['created_at' => $basetime->subDays($file_count - $i)]);
            //
            // }
            //
            // DB::statement("UPDATE phase_power_data SET orders = applied_orders where phase_id IN (SELECT distinct p.id FROM phase_power_data INNER JOIN phases p on phase_power_data.phase_id = p.id WHERE game_id = $game->id)");

        }
    }
}
