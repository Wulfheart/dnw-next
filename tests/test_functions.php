<?php

use App\Actions\Game\CreateGameAction;
use App\Actions\Game\Fake\FakeFillGameAction;
use App\Models\Game;
use App\Models\PhasePowerData;
use App\Models\Variant;
use Carbon\CarbonInterface;
use Database\Seeders\VariantSeeder;

function setupGame(): Game
{
    $user = \App\Models\User::factory()->create();
    if (Variant::query()->count() == 0) {
        test()->seed(VariantSeeder::class);
    }
    $game = CreateGameAction::run(
        $user,
        faker()->name,
        CarbonInterface::MINUTES_PER_HOUR * CarbonInterface::HOURS_PER_DAY,
        Variant::firstOrFail()->id,
        [],
        false,
        \App\Models\MessageMode::factory()->create()->id
    );

    FakeFillGameAction::run($game);

    return $game;
}

function getCurrentPhaseDataForPower(Game $game, string $power): PhasePowerData
{
    $game->loadMissing('currentPhase.phasePowerData.power.basePower');

    return $game->currentPhase->phasePowerData->filter(
        fn(PhasePowerData $ppd) => $ppd->power->basePower->api_name == $power
    )->firstOrFail();
}
