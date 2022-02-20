<?php


use App\Actions\Game\InitializeGameAction;

it('can create a game', function () {

    Queue::fake();

    InitializeGameAction::assertPushed();


})->skip();
