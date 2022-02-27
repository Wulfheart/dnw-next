<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Actions\Game\CreateGameAction;
use App\Actions\Game\Fake\FakeFillGameAction;
use App\Models\Game;
use App\Models\PhasePowerData;
use App\Models\Variant;
use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\TestWithCachingAdjudicatorImplementation;
use Carbon\CarbonInterface;
use Database\Seeders\VariantSeeder;

uses(Tests\TestCase::class)
    ->beforeEach(fn() => app()->bind(AdjudicatorService::class, TestWithCachingAdjudicatorImplementation::class))
    ->in('Feature', 'Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/


function setupGame(): Game
{
    $user = \App\Models\User::factory()->create();
    if (Variant::query()->count() == 0) {
        test()->seed(VariantSeeder::class);
    }
    $game = CreateGameAction::run($user, faker()->name,
        CarbonInterface::MINUTES_PER_HOUR * CarbonInterface::HOURS_PER_DAY, Variant::firstOrFail()->id, [], false);

    FakeFillGameAction::run($game);

    return $game;
}

function getCurrentPhaseDataForPower(Game $game, string $power): PhasePowerData
{
    $game->loadMissing('currentPhase.phasePowerData.power.basePower');

    return $game->currentPhase->phasePowerData->filter(fn(PhasePowerData $ppd
    ) => $ppd->power->basePower->name == $power)->firstOrFail();
}
