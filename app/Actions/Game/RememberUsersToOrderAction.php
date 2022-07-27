<?php

namespace App\Actions\Game;

use App\Builders\GameBuilder;
use App\Models\Game;
use App\Models\Phase;
use App\Models\PhasePowerData;
use App\Notifications\Game\NoOrderReceivedYetNotification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class RememberUsersToOrderAction
{
    use AsAction;

    public function handle()
    {

        $candidates = Game::with('currentPhase.phasePowerData.power.user')
            ->whereActive()
            ->whereNotAdjudicating()
            ->whereHas('currentPhase', function (Builder $builder) {
                $builder->where('adjudication_at', '<=', now()->addHour());
            })
            ->whereHas('currentPhase.phasePowerData', function (Builder $builder) {
                $builder->where('orders_needed', 1)->whereNull('orders');
            })->get()->pluck('currentPhase.phasePowerData')->flatten();

        $candidates->each(function (PhasePowerData $phasePowerData) {
            if (DB::table('remember_user_to_order_table')->where('phase_power_data_id',
                $phasePowerData->id)->exists()) {
                return;
            }
            $phasePowerData->power->user->notify(new NoOrderReceivedYetNotification($phasePowerData->phase_id));

            DB::table('remember_user_to_order_table')->insert([
                'phase_power_data_id' => $phasePowerData->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);


        });
    }
}
