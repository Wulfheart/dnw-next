<?php

use App\Actions\Game\CreateGameAction;
use App\Actions\Game\JoinGameAction;
use App\Events\Game\GameStartedEvent;
use App\Models\Game;
use App\Models\Power;
use App\Models\User;
use App\Models\Variant;
use Carbon\CarbonInterface;
use Database\Seeders\VariantSeeder;

test('a user can join a game', function () {

})->skip(true, "TODO");

test('a user can leave a game', function () {

})->skip(true, "TODO");

it('dispatches the correct event when it starts', function () {
    $user = \App\Models\User::factory()->create();

    test()->seed(VariantSeeder::class);
    $variant = Variant::firstOrFail();
    $game = CreateGameAction::run($user, faker()->name,
        CarbonInterface::MINUTES_PER_HOUR * CarbonInterface::HOURS_PER_DAY, $variant->id, [], false);

    $game->load('powers');
    $game->powers->whereUserNotAssigned()->random(5)->each(fn(Power $p
    ) => $p->update(['user_id' => User::factory()->create()->id]));

    $game->load('powers');
    expect($game->powers->whereUserAssigned()->count())->toEqual(6);

    Event::fake();
    JoinGameAction::run(User::factory()->create(), $game);
    Event::assertDispatched(GameStartedEvent::class);

});
