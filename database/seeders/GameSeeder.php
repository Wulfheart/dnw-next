<?php

namespace Database\Seeders;

use App\Jobs\AdjudicateGameJob;
use App\Jobs\InitializeGameJob;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\Power;
use App\Models\User;
use App\Models\Variant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ([0,6] as $i) {
            $variant = Variant::first();

            $game = Game::create([
                'name' => faker()->catchPhrase,
                'phase_length' => Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
                'variant_id' => $variant->id,
                'scs_to_win' => $variant->default_scs_to_win,
            ]);

            $game->load('variant.basePowers', 'powers');
            $game->variant->basePowers()->each(fn(BasePower $b) => Power::create([
                'base_power_id' => $b->id,
                'game_id' => $game->id,
            ]));

            $powers = $game->powers()->whereNull('user_id')->get()->random($i);

            $powers->each(fn(Power $p) => $p->update(['user_id' => User::factory()->create()->id]));


            dispatch_sync(new InitializeGameJob($game->id));
        }

    }

}