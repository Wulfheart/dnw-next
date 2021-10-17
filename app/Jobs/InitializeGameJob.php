<?php

namespace App\Jobs;

use App\Models\Game;
use App\Models\Phase;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\DTO\PhasePowerDataDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InitializeGameJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public int $game_id,
        public bool $save_response = false,
    )
    {
    }

    /**
     * @throws \Throwable
     */
    public function handle(AdjudicatorService $adjudicator)
    {
        DB::transaction(function() use ($adjudicator) {
            /** @var Game $game */
            $game = Game::with(['variant', 'powers.basePower'])->findOrFail($this->game_id);
            $gameResponse = $adjudicator->initializeGame($game->variant->api_name);

            if($this->save_response){
                Storage::drive('gamedata')->put(Str::of($game->name . $game->id)->remove(" ")->lower() .  "/0_{$gameResponse->phase_short}.json", $gameResponse->json);
            }

            $phase = Phase::create([
                'adjudicated_at' => now(),
                'phase_name_long' => $gameResponse->phase_long,
                'phase_name_short' => $gameResponse->phase_short,
                'type' => match($gameResponse->phase_type) {
                    'M' => 'MOVEMENT',
                    'A' => 'ADJUSTMENT',
                    'R' => 'RETREAT',
                    '-' => 'NON_PLAYING'
                },
                'state_encoded' => $gameResponse->current_state_encoded,
                'svg_adjudicated' => $gameResponse->svg_adjudicated,
                'game_id' => $game->id,
            ]);

            /** @var Power $power */
            foreach ($game->powers as $power){
                /** @var \App\Utility\Game\DTO\PhasePowerDataDTO $ppd */
                $ppd = $gameResponse->phase_power_data->filter(
                    fn(PhasePowerDataDTO $item) => $item->power == $power->basePower->api_name
                )->first();
                $orders_needed = $gameResponse->possible_orders->filter(
                        fn($item) => $item->power == $power->basePower->api_name
                    )->first()->units->filter(
                        fn($item) => count($item->possible_orders) > 0
                    )->count() > 0;
                PhasePowerData::create([
                    'phase_id' => $phase->id,
                    'power_id' => $power->id,
                    'supply_center_count' => $ppd->supply_center_count,
                    'home_center_count' => $ppd->home_center_count,
                    'unit_count' => $ppd->unit_count,
                    'orders_needed' => $orders_needed,
                ]);
            }
        });


    }
}
