<?php

use App\Actions\Game\AdjudicateGameAction;
use App\Actions\Game\CreateGameAction;

it('can adjudicate a game', function () {
    $game = setupGame();

    expect($game->phases()->count())->toBeOne();
    $previousPhase = $game->currentPhase;
    expect($previousPhase)->not()->toBeNull();

    AdjudicateGameAction::run($game->id);

    $game->load('currentPhase');
    $currentPhase = $game->currentPhase;
    expect($previousPhase)->not->toBe($currentPhase)
        ->and($game->phases()->count())->toBe(2)
        ->and($currentPhase->adjudication_at)->not()->toBeNull()
        ->and($currentPhase->adjudication_at->greaterThan(now()))->toBeTrue();

});
