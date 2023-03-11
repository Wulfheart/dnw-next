<?php

namespace App\Console;

use App\Actions\Game\AutomaticAdjudicationAtPhaseEndAction;
use App\Actions\Game\CreateGameAction;
use App\Actions\Game\RememberUsersToOrderAction;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Lorisleiva\Actions\Facades\Actions;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // CreateGameAction::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            AutomaticAdjudicationAtPhaseEndAction::run();
        })->everyMinute()->name('adjudicate')->withoutOverlapping();
        $schedule->call(function () {
            RememberUsersToOrderAction::run();
        })->everyMinute()->name('remember-users-to-order')->withoutOverlapping();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
