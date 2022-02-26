<?php

use App\Actions\Game\CreateGameAction;
use App\Actions\Game\Fake\FakeFillGameAction;
use App\Models\Game;
use App\Models\PhasePowerData;
use App\Models\Power;
use App\Models\Variant;
use Carbon\CarbonInterface;
use Database\Seeders\VariantSeeder;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\AssignOp\Pow;

it('it does not advance automatically if orders are needed', function () {
    $game = setupGame();
    expect(Game::count())->toBeOne();

    // Spring 1901 M
});

