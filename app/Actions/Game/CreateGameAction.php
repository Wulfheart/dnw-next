<?php

namespace App\Actions\Game;

use App\Http\Requests\StoreGameRequest;
use App\Jobs\InitializeGameJob;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\Power;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Response;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateGameAction
{
    use AsAction;

    public string $commandSignature = 'dnw:game:create';

    public function handle(User $user, string $name, int $phase_length, int $variant_id, array $no_adjudication, bool $async): Game
    {
        $game = Game::create([
            'name' => $name,
            'phase_length' => $phase_length,
            'variant_id' => $variant_id,
        ]);


        // TODO: Test if always accepted
        $game->noAdjudicationDays()->createMany(collect(
            $no_adjudication)->keys()->unique()->map(
            fn(int $iso_weekday) => ['iso_weekday' => $iso_weekday]
        )->toArray());

        $game->load('variant.basePowers');
        $game->variant->basePowers()->each(fn (BasePower $b) => Power::create([
            'base_power_id' => $b->id,
            'game_id' => $game->id,
        ]));

        $game->load('powers');
        /** @var Power $power */
        $power = $game->powers->random();
        $power->update(['user_id' => $user->id]);

        if($async){
            InitializeGameAction::dispatch($game->id, false);
        } else {
            InitializeGameAction::run($game->id, false);
        }

        return $game;


    }

    public function asController(User $user, StoreGameRequest $request): \Illuminate\Http\RedirectResponse
    {
        $game = $this->handle($user, $request->get('name'), $request->get('phase_length'), $request->get('variant_id'), $request->get('no_adjudication'), true);
        return redirect()->route('games.show', ['game' => $game]);
    }

    public function asCommand(Command $command): void
    {
        $name = $command->ask("Name of the game");
        $variantName = $command->choice("Variant", Variant::all()->pluck('name')->toArray(), 0);
        $variant_id = Variant::where('name', $variantName)->firstOrFail()->id;
        $phaseLength = (int) $command->ask("Phase length");
        $command->choice('User', User::all()->pluck('name')->toArray(), 0);

        // $this->handle()
    }
}
