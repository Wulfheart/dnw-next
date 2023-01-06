<?php

use App\Actions\Game\InitializeGameAction;
use App\Models\Game;
use App\Models\User;
use App\Models\Variant;
use Carbon\CarbonInterface;
use Database\Seeders\VariantSeeder;
use function Pest\Laravel\actingAs;

it('can create a game without "no adjudication"', function () {
    Queue::fake();
    $this->seed(VariantSeeder::class);

    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('games.store'), [
        'name' => 'Conquerors of the old world',
        'variant_id' => Variant::first()->id,
        'phase_length' => CarbonInterface::HOURS_PER_DAY * CarbonInterface::MINUTES_PER_HOUR,
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertRedirect();

    expect(Game::count())->toBeOne();

    // InitializeGameAction::assertPushed();
});

it('can create a game with "no adjudication day"', function () {
    Queue::fake();
    $this->seed(VariantSeeder::class);

    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('games.store'), [
        'name' => 'Conquerors of the old world',
        'variant_id' => Variant::first()->id,
        'phase_length' => CarbonInterface::HOURS_PER_DAY * CarbonInterface::MINUTES_PER_HOUR,
        'no_adjudication' => [
            1 => 1,
            2 => 1,
            3 => 1,
            4 => 1,
            5 => 1,
            6 => 1,
            7 => 0,
        ],
    ]);
    $response->assertSessionHasNoErrors();

    $response->assertRedirect();

    expect(Game::count())->toEqual(1);
    /** @var Game $game */
    $game = Game::with('noAdjudicationDays')->first();
    expect($game->noAdjudicationDays()->count())->toEqual(6);
});

it('cannot create a game with seven "no adjudication day"', function () {
    Queue::fake();
    $this->seed(VariantSeeder::class);

    $user = User::factory()->create();
    actingAs($user);

    $response = $this->post(route('games.store'), [
        'name' => 'Conquerors of the old world',
        'variant_id' => Variant::first()->id,
        'phase_length' => CarbonInterface::HOURS_PER_DAY * CarbonInterface::MINUTES_PER_HOUR,
        'no_adjudication' => [
            1 => 1,
            2 => 1,
            3 => 1,
            4 => 1,
            5 => 1,
            6 => 1,
            7 => 1,
        ],
    ]);

    $response->assertSessionHasErrors('no_adjudication');
    expect(Game::count())->toEqual(0);
});
