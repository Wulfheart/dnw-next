<?php

namespace App\Jobs;

use App\Models\Game;
use App\Models\Phase;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\DTO\AdjudicateGameRequestDTO;
use App\Utility\Game\DTO\OrderDTO;
use App\Utility\Game\DTO\PhasePowerDataDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdjudicateGameJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        public int $game_id
    ) {
    }


    /**
     * @throws \Throwable
     */
    public function handle(AdjudicatorService $adjudicator)
    {
        DB::transaction(function() use ($adjudicator){
            /** @var Game $game */
            $game = Game::with(['variant', 'powers.basePower', 'currentPhase.phasePowerData.power.basePower'])->findOrFail($this->game_id);
            $currentPhase = $game->currentPhase;


            $gameResponse = $adjudicator->adjudicateGame(new AdjudicateGameRequestDTO(
                previous_state_encoded: $currentPhase->state_encoded,
                orders: $game->currentPhase->phasePowerData->map(
                    fn(PhasePowerData $ppd) => new OrderDTO(
                        power: $ppd->power->basePower->api_name,
                        instructions: Str::of($ppd->orders)->split('/\r\n|\n|\r/')
                    )
                ),
                scs_to_win: $game->scs_to_win,
            ));

            $currentPhase->update([
                'svg_with_orders' => $gameResponse->svg_with_orders
            ]);

            foreach ($gameResponse->applied_orders as $applied_order){
                PhasePowerData::where('phase_id', $currentPhase->id)
                    ->where('power_id', $game->powers->filter(
                        fn(Power $power) => $power->basePower->api_name == $applied_order->power
                    )->first()->id)
                    ->update(['applied_orders' => collect($applied_order->orders)->implode('\n')]);
            }


            $newPhase = Phase::create([
                'game_id' => $game->id,
                'previous_phase_id' => $currentPhase->id,
                'state_encoded' => $gameResponse->current_state_encoded,
                'adjudicated_at' => now(),
                'phase_name_long' => $gameResponse->phase_long,
                'phase_name_short' => $gameResponse->phase_short,
                'type' => match($gameResponse->phase_type) {
                    'M' => 'MOVEMENT',
                    'A' => 'ADJUSTMENT',
                    'R' => 'RETREAT',
                    '-' => 'NON_PLAYING'
                },
                'svg_adjudicated' => $gameResponse->svg_adjudicated,
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
                    'phase_id' => $currentPhase->id,
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
