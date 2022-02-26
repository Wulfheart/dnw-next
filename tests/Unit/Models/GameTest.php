<?php

use App\Models\Game;
use App\Models\NoAdjudication;
use App\Models\Phase;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use function Pest\Laravel\assertDatabaseCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

it('can get retrieve the current phase as relationship', function () {
    $game = \App\Models\Game::factory()->create();

    $phase = null;
    for ($i = 0; $i < 3; $i++) {
        $phase = \App\Models\Phase::factory()->create([
            'number' => $i,
            'game_id' => $game->id,
            'adjudicated_at' => now()->subYear()->addDays($i),
        ]);
    }

    assertDatabaseCount(Phase::class, 3);
    $game->load('currentPhase');
    assertNotNull($phase);
    assertNotNull($game->currentPhase);
    assertEquals($phase->id, $game->currentPhase->id);
});

it('evaluates the correct game state', function () {

})->skip(true, 'TODO');

it('calculates the correct phase time for a new phase', function ($hours, $start, $end) {
    /** @var Game $game */
    $game = Game::factory()->create([
        'phase_length' => CarbonInterface::MINUTES_PER_HOUR * $hours,
    ]);

    $game->noAdjudicationDays()->createMany([
        // Monday
        ['iso_weekday' => 1],
        // Wednesday
        ['iso_weekday' => 3],
    ]);

    $game->load('noAdjudicationDays');
    expect($game->noAdjudicationDays()->count())->toEqual(2);

    test()->travelTo($start);
    $result = $game->calculateNextAdjudicationPhaseEnd();
    expect($result->equalTo($end))->toBeTrue();

})->with([
    '3h Thursday 22:00' => [3, '2022-02-24 22.00', '2022-02-25 01.00'],
    '3h Tuesday 22:00' => [3, '2022-02-22 22.00', '2022-02-24 01.00'],
    '24h Tuesday 15:00' => [24, '2022-02-22 15.00', '2022-02-24 15.00'],
]);
