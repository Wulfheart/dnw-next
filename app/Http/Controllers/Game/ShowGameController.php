<?php

namespace App\Http\Controllers\Game;

use App\DTO\Views\PhaseDTO;
use App\Enums\GameStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Phase;
use App\Models\PhasePowerData;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class ShowGameController extends Controller
{
    public function __invoke(Request $request, Game $game)
    {
        // $this->authorize('view', $game);

        $game->load([
            'powers.basePower',
            'powers.user',
            'winners',
            'currentPhase.phasePowerData.power.basePower',
            'currentPhase.phasePowerData.power.user',
            'phases' => function ($query) {
                $query->select(collect(Schema::getColumnListing(app(Phase::class)->getTable()))->reject(fn(string $v
                ) => $v === 'state_encoded')->toArray());
            },
        ]);

        $phases = $game->phases->map(fn(Phase $phase) => collect()
            ->when(!is_null($phase->svg_with_orders), fn(Collection $c) => $c->put($phase->phase_name_short."_with_orders",
                PhaseDTO::factory()->setKey($phase->phase_name_short."_with_orders")->setSvg($phase->svg_with_orders)
                )
            )
            ->when(!is_null($phase->svg_adjudicated), fn(Collection $c) => $c->put($phase->phase_name_short."_adjudicated",
                PhaseDTO::factory()->setKey($phase->phase_name_short."_adjudicated")->setSvg($phase->svg_adjudicated)
                )
            )
        )->flatMap(fn($values) => $values);

        $user = auth()->user();

        /** @var PhasePowerData $userPhasePowerData */
        $userPhasePowerData = $game->currentPhase->phasePowerData->filter(fn(PhasePowerData $ppd) => $ppd->power->user_id == $user->id)->first();

        $ordersSubmittable = !$userPhasePowerData?->ready_for_adjudication && $userPhasePowerData?->orders_needed;
        $userIsMember = $game->currentState() == GameStatusEnum::RUNNING && $game->powers->contains('user_id', $user->id);

        $response = response()->view('game.show', [
            'is_still_creating' => is_null($game->currentPhase),
            'phases' => $phases,
            'phase_keys' => $phases->keys(),
            'game' => $game,
            'gameState' => $game->currentState(),
            'ordersSubmittable' => $ordersSubmittable,
            'userIsMember' => $userIsMember,
            'ordersNeeded' => $userPhasePowerData?->orders_needed,
            'ordersReady' => $userPhasePowerData?->ready_for_adjudication,
            'orders' => $userPhasePowerData?->orders,
            'adjudicationInProgress' => $game->currentPhase->adjudicationStarted(),
            'userPower' => $userPhasePowerData?->power,
            'user' => $user,
        ]);

        if($game->currentPhase->adjudication_at){
            $response->header('Refresh', $game->currentPhase->adjudication_at->diffInSeconds() + 5);
        }

        return $response;

    }
}
