<?php

namespace App\Http\Controllers\Game;

use App\Actions\Game\CheckForAdjudicationReady;
use App\Actions\Game\SubmitOrdersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitOrdersRequest;
use App\Models\Game;
use App\Models\PhasePowerData;
use Illuminate\Http\Request;

class SubmitOrdersController extends Controller
{
    public function __invoke(SubmitOrdersRequest $request, Game $game)
    {
        $this->authorize('submitOrders', $game);

        $orders = $request->get('orders');
        $ready = $request->boolean('ready');

        $game->loadMissing('currentPhase.phasePowerData.power');

        /** @var PhasePowerData $phasePowerData */
        $phasePowerData = $game->currentPhase->phasePowerData
            ->filter(
                fn(PhasePowerData $phasePowerData) => $phasePowerData->power->user_id == auth()->user()->id
            )
            ->firstOrFail();

        $phasePowerData->update([
            'orders' => $orders,
            'ready_for_adjudication' => $ready,
        ]);

        CheckForAdjudicationReady::run($game);

        return redirect()->route('games.show', $game);
    }
}
