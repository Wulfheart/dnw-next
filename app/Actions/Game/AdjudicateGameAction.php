<?php

namespace App\Actions\Game;

use App\Enums\GameStatusEnum;
use App\Enums\PhaseTypeEnum;
use App\Models\Game;
use App\Models\Phase;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\DTO\AdjudicateGameRequestDTO;
use App\Utility\Game\DTO\OrderDTO;
use App\Utility\Game\DTO\PhasePowerDataDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use Ramsey\Uuid\Uuid;

class AdjudicateGameAction
{
    use AsAction;

    public function __construct(public AdjudicatorService $adjudicator)
    {
    }

    public function handle(int $game_id, bool $save_response = false)
    {
        $adjudicator = $this->adjudicator;
        DB::transaction(function () use ($adjudicator, $game_id, $save_response) {
            /** @var Game $game */
            $game = Game::with([
                'variant', 'powers.basePower', 'currentPhase.phasePowerData.power.basePower',
            ])->findOrFail($game_id);
            $currentPhase = $game->currentPhase;


            $gameResponse = $adjudicator->adjudicateGame(new AdjudicateGameRequestDTO(
                previous_state_encoded: $currentPhase->state_encoded,
                orders: $game->currentPhase->phasePowerData->map(
                    fn(PhasePowerData $ppd) => new OrderDTO(
                        power: $ppd->power->basePower->api_name,
                        instructions: Str::of($ppd->orders)->split('/\r\n|\n|\r/')->toArray()
                    )
                )->toArray(),
                scs_to_win: $game->scs_to_win,
            ));

            if ($save_response) {
                Storage::drive('gamedata')->put(Str::of($game->name.$game->id)->remove(" ")->lower()."/{$game->phases()->count()}_{$gameResponse->phase_short}.json",
                    $gameResponse->json);
            }


            $path = "maps/".Uuid::uuid4().".svg";
            Storage::drive('public')->put($path, $gameResponse->svg_with_orders);

            $currentPhase->update([
                'svg_with_orders' => $path,
            ]);

            foreach ($gameResponse->applied_orders as $applied_order) {
                PhasePowerData::where('phase_id', $currentPhase->id)
                    ->where('power_id', $game->powers->filter(
                        fn(Power $power) => $power->basePower->api_name == $applied_order->power
                    )->first()->id)
                    ->update(['applied_orders' => collect($applied_order->orders)->implode('\n')]);
            }


            $path = "maps/".Uuid::uuid4().".svg";
            Storage::drive('public')->put($path, $gameResponse->svg_adjudicated);

            $newPhase = Phase::create([
                'game_id' => $game->id,
                'number' => $currentPhase->number + 1,
                'state_encoded' => $gameResponse->current_state_encoded,
                'adjudicated_at' => now(),
                'phase_name_long' => Str::of($gameResponse->phase_long)->contains('?') ? $gameResponse->phase_short : $gameResponse->phase_long,
                'phase_name_short' => $gameResponse->phase_short,
                'type' => PhaseTypeEnum::from($gameResponse->phase_type),
                'svg_adjudicated' => $path,
            ]);

            /** @var Power $power */
            foreach ($game->powers as $power) {
                /** @var \App\Utility\Game\DTO\PhasePowerDataDTO $ppd */
                $ppd = $gameResponse->phase_power_data->filter(
                    fn(PhasePowerDataDTO $item) => $item->power == $power->basePower->api_name
                )->first();
                $orders_needed = $gameResponse->possible_orders->filter(
                        fn($item) => $item->power == $power->basePower->api_name
                    )->first()->units->filter(
                        fn($item) => count($item->possible_orders) > 0
                    )->count() > 0;
                /** @var PhasePowerData $phasePowerData */
                $phasePowerData = PhasePowerData::create([
                    'phase_id' => $newPhase->id,
                    'power_id' => $power->id,
                    'supply_center_count' => $ppd->supply_center_count,
                    'home_center_count' => $ppd->home_center_count,
                    'unit_count' => $ppd->unit_count,
                    'orders_needed' => $orders_needed,
                ]);

                if ($phasePowerData->supply_center_count + $phasePowerData->unit_count === 0) {
                    $power->update(['is_defeated' => true]);
                }
            }

            $game->powers->filter(fn(Power $p) => collect($gameResponse->winners)->contains($p->basePower->api_name))
                ->each(fn(Power $p) => $p->update(['is_winner' => true]));
        });
    }
}
