<?php

use App\Actions\Game\AdjudicateGameAction;
use App\Actions\Game\CheckForAdjudicationReady;
use App\Actions\Game\Fake\FakeOrdersAction;

test('example', function () {
    Queue::fake();
    $game = setupGame();
    FakeOrdersAction::run($game, true);

    CheckForAdjudicationReady::run($game);
    AdjudicateGameAction::assertPushed(1);
    CheckForAdjudicationReady::run($game);
    AdjudicateGameAction::assertPushed(1);
});
