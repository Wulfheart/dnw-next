<?php


use App\Actions\Game\InitializeGameAction;
use App\Http\Requests\StoreGameRequest;
use App\Models\Game;
use App\Models\User;
use App\Models\Variant;
use Carbon\Carbon;
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

    $response->assertRedirect();

    expect(Game::count())->toBeOne();

    InitializeGameAction::assertPushed();
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
        // 'no_adjudication' => [1,2]
    ]);

    // $response->assertRedirect();
    expect(Game::count())->toBeOne();
    // InitializeGameAction::assertPushed();
});
