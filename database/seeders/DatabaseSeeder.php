<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Variant;
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
            'email_verified_at' => now(),
            'password' => \Hash::make('123'),
        ]);

        $this->call([
            VariantSeeder::class,
            GameSeeder::class,
            GameRecreatorSeeder::class,
        ]);
    }
}
