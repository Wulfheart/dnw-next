<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lorisleiva\Actions\Facades\Actions;

class ActionsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Actions::registerCommands();
    }
}
