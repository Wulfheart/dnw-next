<?php

use App\Actions\Game\CreateGameAction;
use App\Actions\Game\Fake\FakeFillGameAction;
use App\Models\Variant;
use Carbon\CarbonInterface;
use Database\Seeders\VariantSeeder;

it('calculates a phase adjudication time when starting', function () {
    $user = \App\Models\User::factory()->create();

    test()->seed(VariantSeeder::class);
    $variant = Variant::firstOrFail();
    $game = CreateGameAction::run(
        $user,
        faker()->name,
        CarbonInterface::MINUTES_PER_HOUR * CarbonInterface::HOURS_PER_DAY,
        $variant->id,
        [],
        false,
        \App\Models\MessageMode::factory()->create()->id,
    );

    $game->load('currentPhase');
    expect($game->currentPhase->adjudication_at)->toBeNull();

    FakeFillGameAction::run($game);
    expect($game->currentPhase->adjudication_at->greaterThan(now()))->toBeTrue();

});