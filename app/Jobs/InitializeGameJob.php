<?php

namespace App\Jobs;

use App\Models\Game;
use App\Models\MessageRoom;
use App\Models\MessageRoomMembership;
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
use Ramsey\Uuid\Uuid;

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

            $path = "maps/". Uuid::uuid4() .".svg";
            Storage::drive('public')->put($path, $gameResponse->svg_adjudicated);

            $phase = Phase::create([
                'adjudicated_at' => now(),
                'number' => 0,
                'phase_name_long' => $gameResponse->phase_long,
                'phase_name_short' => $gameResponse->phase_short,
                'type' => match($gameResponse->phase_type) {
                    'M' => 'MOVEMENT',
                    'A' => 'ADJUSTMENT',
                    'R' => 'RETREAT',
                    '-' => 'NON_PLAYING'
                },
                'state_encoded' => $gameResponse->current_state_encoded,
                'svg_adjudicated' => $path,
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

            // Message Rooms

            MessageRoom::create([
                'name' => 'Global',
                'is_group' => true,
            ])->memberships()->createMany(
                $game->powers->pluck('id')->map(fn(int $item) => ['power_id' => $item])->toArray()
            );


            $c = $game->powers->count();
            for($i = 0; $i < $c; $i++){
                /** @var \App\Models\Power $power_1 */
                $power_1 = $game->powers->get($i);
                for($j = $i; $j < $c; $j++){
                    if($i != $j){
                        /** @var Power $power_2 */
                        $power_2 = $game->powers->get($j);
                        MessageRoom::create([
                            'name' => $power_1->basePower->name . $power_2->basePower->name,
                            'is_group' => false,
                        ])->memberships()->createMany([
                            ['power_id' => $power_1->id],
                            ['power_id' => $power_2->id],
                        ]);
                    }
                }
            }
        });


    }
}
