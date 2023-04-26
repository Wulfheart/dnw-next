<?php

namespace App\Actions\Game;

use App\Enums\GameStatusEnum;
use App\Enums\PhaseTypeEnum;
use App\Events\Game\GameAdjudicatedEvent;
use App\Models\Game;
use App\Models\Phase;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\DTO\AdjudicateGameRequestDTO;
use App\Utility\Game\DTO\AdjudicateGameResponseDTO;
use App\Utility\Game\DTO\OrderDTO;
use App\Utility\Game\DTO\PhasePowerDataDTO;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class AdjudicateGameAction
{
    public function __construct(
        private readonly AdjudicatorService $adjudicator,
        private readonly FinishGameAction $finishGameAction,
    ) {
    }

    public function handle(int $game_id): void
    {
        /** @var Game $game */
        $game = Game::with([
            'variant', 'powers.basePower', 'currentPhase.phasePowerData.power.basePower',
        ])->findOrFail($game_id);
        $currentPhase = $game->currentPhase;

        $adjudicator = $this->adjudicator;
        DB::transaction(function () use ($adjudicator, $game, $currentPhase) {
            $gameResponse = $this->fetchAdjudicatedState($adjudicator, $currentPhase, $game);

            $this->saveAdjudicatedMapToOldPhase($gameResponse, $currentPhase);

            $this->applyOrdersToOldPhase($gameResponse, $currentPhase, $game);

            $newPhase = $this->createNewPhase($gameResponse, $game, $currentPhase);
            $this->createPhasePowerDataForNewPhase($game, $gameResponse, $newPhase);

            $hasWinner = ! empty($gameResponse->winners);
            if ($hasWinner) {
                $this->finishGameAction->handle($game, $gameResponse->winners);
            } elseif ($game->currentState() == GameStatusEnum::RUNNING) {
                event(new GameAdjudicatedEvent($game));
                Event::dispatch(new GameAdjudicatedEvent($game));
            }
        });
    }

    /**
     * @throws UnknownProperties
     */
    private function fetchAdjudicatedState(
        AdjudicatorService $adjudicator,
        Phase $currentPhase,
        Game $game
    ): AdjudicateGameResponseDTO {
        return $adjudicator->adjudicateGame(new AdjudicateGameRequestDTO(
            previous_state_encoded: $currentPhase->state_encoded,
            orders: $game->currentPhase->phasePowerData->map(
                fn (PhasePowerData $ppd) => new OrderDTO(
                    power: $ppd->power->basePower->api_name,
                    instructions: Str::of($ppd->orders)->split('/\r\n|\n|\r/')->toArray()
                )
            )->toArray(),
            scs_to_win: $game->scs_to_win,
        ));
    }

    private function saveAdjudicatedMapToOldPhase(
        AdjudicateGameResponseDTO $gameResponse,
        Phase $currentPhase
    ): void {
        $path = 'maps/'.Uuid::uuid4().'.svg';
        Storage::drive('public')->put($path, $gameResponse->svg_with_orders);

        $currentPhase->update([
            'svg_with_orders' => $path,
        ]);
    }

    private function applyOrdersToOldPhase(
        AdjudicateGameResponseDTO $gameResponse,
        Phase $currentPhase,
        Game $game): void
    {
        foreach ($gameResponse->applied_orders as $applied_order) {
            PhasePowerData::where('phase_id', $currentPhase->id)
                ->where('power_id', $game->powers->filter(
                    fn (Power $power) => $power->basePower->api_name == $applied_order->power
                )->first()->id)
                ->update(['applied_orders' => collect($applied_order->orders)->implode('\n')]);
        }
    }

    private function createNewPhase(
        AdjudicateGameResponseDTO $gameResponse,
        Game $game,
        Phase $currentPhase
    ): Phase {
        $path = 'maps/'.Uuid::uuid4().'.svg';
        Storage::drive('public')->put($path, $gameResponse->svg_adjudicated);

        return Phase::create([
            'game_id' => $game->id,
            'number' => $currentPhase->number + 1,
            'state_encoded' => $gameResponse->current_state_encoded,
            'adjudicated_at' => now(),
            'adjudication_at' => $game->calculateNextAdjudicationPhaseEnd(),
            'phase_name_long' => Str::of($gameResponse->phase_long)->contains('?') ? $gameResponse->phase_short : $gameResponse->phase_long,
            'phase_name_short' => $gameResponse->phase_short,
            'type' => PhaseTypeEnum::from($gameResponse->phase_type),
            'svg_adjudicated' => $path,
        ]);
    }

    private function createPhasePowerDataForNewPhase(Game $game,
                                                     AdjudicateGameResponseDTO $gameResponse,
                                                     Phase $newPhase): void
    {
        /** @var Power $power */
        foreach ($game->powers as $power) {
            /** @var PhasePowerDataDTO $ppd */
            $ppd = $gameResponse->phase_power_data->filter(
                fn (PhasePowerDataDTO $item) => $item->power == $power->basePower->api_name
            )->first();
            $orders_needed = $gameResponse->possible_orders->filter(
                fn ($item) => $item->power == $power->basePower->api_name
            )->first()->units->filter(
                fn ($item) => count($item->possible_orders) > 0
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
    }
}
