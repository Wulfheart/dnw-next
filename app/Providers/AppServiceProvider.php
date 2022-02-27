<?php

namespace App\Providers;

use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\WebAdjudicatorImplementation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        AdjudicatorService::class => WebAdjudicatorImplementation::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Model::preventLazyLoading(config('app.env') !== 'production');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
