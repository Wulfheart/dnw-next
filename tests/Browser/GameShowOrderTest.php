<?php

namespace Tests\Browser;

use App\Actions\Game\AdjudicateGameAction;
use Database\Seeders\VariantSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

require 'tests/test_functions.php';

class GameShowOrderTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testOrderSubmissionUserInterface()
    {
        $this->seed(VariantSeeder::class);
        $game = setupGame();
        $phasePowerData = getCurrentPhaseDataForPower($game, 'FRANCE');
        $phasePowerData->loadMissing('power.user');


        $this->browse(function (Browser $browser) use ($game, $phasePowerData) {
            $selectorReadyButton = '[x-dusk="order-button-ready"]';
            $selectorNotReadyButton = '[x-dusk="order-button-not-ready"]';
            $selectorSaveButton = '[x-dusk="order-button-save"]';
            $selectorOrderTextarea = '[x-dusk="order-textarea"]';
            $interactor = $browser->loginAs($phasePowerData->power->user)->visit(route('games.show', $game));

            $interactor->assertNotPresent($selectorNotReadyButton)
                ->assertButtonEnabled($selectorReadyButton)
                ->assertButtonEnabled($selectorSaveButton)
                ->assertVisible($selectorOrderTextarea)
                ->assertInputValue($selectorOrderTextarea, "")
                ->type($selectorOrderTextarea, '::FOO::')
                ->click($selectorSaveButton)
                ->assertInputValue($selectorOrderTextarea, '::FOO::')
                ->assertEnabled($selectorOrderTextarea)
                ->click($selectorReadyButton)
                // Now the user is ready for adjudication
                ->assertDisabled($selectorOrderTextarea)
                ->assertButtonEnabled($selectorNotReadyButton)
                ->assertNotPresent($selectorReadyButton)
                ->assertNotPresent($selectorSaveButton)
                ->click($selectorNotReadyButton)
                // Now the user can submit orders again
                ->assertInputValue($selectorOrderTextarea, '::FOO::');

            $austria = getCurrentPhaseDataForPower($game, 'AUSTRIA');
            $austria->updateOrFail(['orders' => 'A BUD - RUM']);
            AdjudicateGameAction::run($game->id);
            AdjudicateGameAction::run($game->id);

            $interactor->visit(route('games.show', $game))->screenshot('TEST');

            // Two adjudications - no builds or disbands needed
            $interactor->assertDisabled($selectorOrderTextarea)
                ->assertButtonDisabled($selectorSaveButton)
                ->assertButtonDisabled($selectorReadyButton);
        });
    }
}
