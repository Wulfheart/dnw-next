<?php

namespace App\Actions\Game\Fake;

use App\Actions\Game\JoinGameAction;
use App\Enums\GameStatusEnum;
use App\Models\Game;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class FakeFillGameAction
{
    use AsAction;

    public string $commandSignature = "dnw:game:fill {--id=}";

    public function handle(Game $game)
    {
        if ($game->currentState() != GameStatusEnum::PREGAME) {
            return;
        }

        $game->loadMissing('powers');

        $users_left = $game->powers->count() - $game->powers->whereUserAssigned()->count();

        User::factory()->count($users_left)->create()->each(fn(User $u) => JoinGameAction::run($u, $game));
    }

    public function asCommand(\Illuminate\Console\Command $command): void
    {
        $game_id = $command->option('id');
        $game = Game::findOrFail($game_id);

        $this->handle($game);


        $command->info("Game (id: $game->id, name: '$game->name') filled with users");
    }

}
