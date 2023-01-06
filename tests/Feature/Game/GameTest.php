<?php

use App\Models\Game;

it('it does not advance automatically if orders are needed', function () {
    $game = setupGame();
    expect(Game::count())->toBeOne();

    // Spring 1901 M
});
