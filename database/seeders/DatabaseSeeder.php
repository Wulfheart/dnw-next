<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Variant;
use App\Utility\Game\AdjudicatorService;
use App\Utility\Game\TestWithCachingAdjudicatorImplementation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.de',
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => \Hash::make('123'),
        ]);

        app()->bind(AdjudicatorService::class, TestWithCachingAdjudicatorImplementation::class);

        $this->call([
            VariantSeeder::class,
            MessageModeSeeder::class,
            GameSeeder::class,
            GameRecreatorSeeder::class,
        ]);
    }
}
