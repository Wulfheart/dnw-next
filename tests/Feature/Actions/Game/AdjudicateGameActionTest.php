<?php

use App\Actions\Game\AdjudicateGameAction;

it('can adjudicate a game', function () {
    $game = setupGame();

    expect($game->phases()->count())->toBeOne();
    $previousPhase = $game->currentPhase;
    expect($previousPhase)->not()->toBeNull();

    AdjudicateGameAction::run($game->id);

    $game->load('currentPhase');
    $currentPhase = $game->currentPhase;
    expect($previousPhase)->not->toBe($currentPhase);
    expect($game->phases()->count())->toBe(2);
    expect($currentPhase->adjudication_at)->not()->toBeNull();
    expect($currentPhase->adjudication_at->greaterThan(now()))->toBeTrue();
});
