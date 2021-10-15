<?php

namespace App\Console\Commands;

use App\Jobs\AdjudicateGameJob;
use App\Jobs\InitializeGameJob;
use App\Models\BasePower;
use App\Models\Game;
use App\Models\Power;
use App\Models\Variant;
use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\DTO\DumbbotRequestDTO;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class SimulateGameCommand extends Command
{
    protected $signature = 'dnw:simulate';

    protected $description = '';

    public function __construct()
    {
        parent::__construct();
        $this->addOption('phases', 'p', InputOption::VALUE_OPTIONAL, "", 15);
    }

    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function handle(AdjudicatorService $adjudicator)
    {
        $this->line("Starting game setup");
        $variant = Variant::first();

        $game = Game::create([
            'name' => faker()->catchPhrase,
            'phase_length' => Carbon::MINUTES_PER_HOUR * Carbon::HOURS_PER_DAY,
            'variant_id' => $variant->id,
            'scs_to_win' => $variant->default_scs_to_win,
        ]);

        $game->load('variant.basePowers');
        $game->variant->basePowers()->each(fn (BasePower $b) => Power::create([
            'base_power_id' => $b->id,
            'game_id' => $game->id,
        ]));
        dispatch_sync(new InitializeGameJob($game->id));
        $this->info("Finished game id $game->id setup");

        $bar = $this->output->createProgressBar($this->option('phases'));

        $bar->start();
        for($i = 0; $i < $this->option('phases'); $i++){
            $game->load('currentPhase.phasePowerData.power.basePower');

            /** @var \App\Models\PhasePowerData $phasePowerData */
            foreach ($game->currentPhase->phasePowerData as $phasePowerData){
                $res = $adjudicator->getDumbbotOrders(new DumbbotRequestDTO(
                    current_state_encoded: $game->currentPhase->state_encoded,
                    power: $phasePowerData->power->basePower->api_name,
                ));
                $phasePowerData->orders = collect($res->orders)->implode("\n");
                $phasePowerData->save();
            }
            dispatch_sync(new AdjudicateGameJob($game->id));
            $bar->advance();
        }
        $bar->finish();
    }
}
