<?php

use App\Jobs\InitializeGameJob;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\Phase;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Models\Variant;
use Database\Seeders\VariantSeeder;
use function Pest\Laravel\assertDatabaseCount;

it('initializes the game correctly', function(){
    $this->seed(VariantSeeder::class);
    $game = Game::factory()->create([
        'variant_id' => Variant::first()->id,
    ]);

    $game->load('variant.basePowers');
    $game->variant->basePowers()->each(fn (BasePower $b) => Power::create([
        'base_power_id' => $b->id,
        'game_id' => $game->id,
    ]));

    assertDatabaseCount(PhasePowerData::class, 0);
    assertDatabaseCount(Phase::class, 0);

    dispatch_sync(new InitializeGameJob($game->id));

    assertDatabaseCount(Phase::class, 1);
    assertDatabaseCount(PhasePowerData::class, 7);
});