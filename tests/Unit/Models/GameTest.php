<?php

use App\Models\Phase;
use function Pest\Laravel\assertDatabaseCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

it('can get retrieve the current phase as relationship', function(){
    $game = \App\Models\Game::factory()->create();

    $phase = null;
    for($i = 0; $i < 3; $i++){
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
    assertEquals($phase->id,$game->currentPhase->id);
});

it('evaluates the correct game state', function(){

})->skip(true, 'TODO');
