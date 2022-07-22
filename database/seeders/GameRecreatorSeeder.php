<?php

namespace Database\Seeders;

use App\Actions\Game\AdjudicateGameAction;
use App\Actions\Game\InitializeGameAction;
use App\Enums\PhaseTypeEnum;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\MessageMode;
use App\Models\Power;
use App\Models\User;
use App\Models\Variant;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;

class GameRecreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = [
            '18741.dnw',
            'fullgame.dnw'
        ];

        $base_path = __DIR__.'/games/';

        foreach ($files as $file) {
            $path = $base_path.$file;

            $csv = Reader::createFromPath($path);

            $csv->setHeaderOffset(0);

            $basetime = now();

            $all = collect($csv->getRecords())
                ->groupBy('turn_phase')
                ->map(fn($c) => $c->groupBy('country'));

            $count = $all->count();

            $variant = Variant::firstOrFail();
            $messageMode = MessageMode::firstOrFail();

            $game = Game::create([
                'name' => faker()->catchPhrase,
                'phase_length' => Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
                'variant_id' => $variant->id,
                'message_mode_id' => $messageMode->id,
                'scs_to_win' => $variant->default_scs_to_win,
                'created_at' => $basetime->subDays($count),
            ]);

            $game->load('variant.basePowers');
            $game->variant->basePowers()->each(fn(BasePower $b) => Power::create([
                'base_power_id' => $b->id,
                'game_id' => $game->id,
                'user_id' => User::factory()->create()->id,
            ]));
            InitializeGameAction::run($game->id, false);
            $this->command->line("");


            foreach ($all as $key => $turn) {

                // Skip if there is a mismatch between the current phase returned by our adjudicator
                // and the one in the CSV. This accounts for the fact that the our adjudicator may have
                // skipped a phase because it has no orders necessary because it automatically
                // disbands units which have no possibility to retreat.
                $game->load('currentPhase');
                $match = [
                    'a' => PhaseTypeEnum::MOVEMENT,
                    'b' => PhaseTypeEnum::RETREAT,
                    'c' => PhaseTypeEnum::ADJUSTMENT,
                ];
                if ($game->currentPhase->type !== $match[mb_substr($key, -1, 1)]) {
                    continue;
                }

                foreach ($turn as $powerName => $power) {
                    $orders = [];
                    foreach ($power as $order) {
                        $unitType = mb_substr($order['unitType'], 0, 1);
                        $territory = $order['territory'];
                        $fromTerritory = $order['fromTerritory'];
                        $toTerritory = $order['toTerritory'];
                        $convoy = \Str::lower($order['viaConvoy']) == 'yes' ? 'VIA' : '';

                        $match = \Str::of($order['type'])->lower()->toString();
                        $orders[] = match ($match) {
                            'move' => "$unitType $territory - $toTerritory $convoy",
                            'hold' => "$unitType $territory H",
                            // This works also without the type of the unit which gets the support
                            'support move' => "$unitType $territory S $fromTerritory - $toTerritory",
                            'support hold' => "$unitType $territory S $toTerritory",
                            'build fleet' => "F $territory B",
                            'build army' => "A $territory B",
                            'convoy' => "$unitType $territory C $fromTerritory - $toTerritory",
                            'retreat' => "$unitType $territory - $toTerritory",
                            'destroy', 'disband' => "$territory D",
                            default => throw new \Exception("$match is not supported")
                        };
                    }

                    $basePowerId = $game->variant->basePowers->where('api_name', $powerName)->first()->id;
                    $powerId = $game->powers->where('base_power_id', $basePowerId)->first()->id;
                    $game->currentPhase->phasePowerData->where(
                        'power_id',
                        $powerId
                    )->first()->update([
                        'orders' => implode(PHP_EOL, $orders),
                        'ready_for_adjudication' => true,
                    ]);
                }

                $pnl = $game->currentPhase->phase_name_long;

                $this->command->info("Adjudicating $pnl");
                AdjudicateGameAction::run($game->id, true, false);

                $phaseName = $game->currentPhase->phase_name_long;
                $phaseTurnName = $order['turn_phase'];
                // $this->command->confirm("Finished $phaseTurnName as $phaseName. Would you like to continue?");
                $game->load('currentPhase.phasePowerData');
                $game->currentPhase()->update([
                    'created_at' => $basetime->addDays($count--),
                ]);
            }

        }

        // Some additional saving to make sure the game is saved correctly
        while($game->load('currentPhase')->currentPhase->type !== PhaseTypeEnum::ADJUSTMENT) {
            AdjudicateGameAction::run($game->id, true, true);
        }
    }
}
