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

        $variant = Variant::create([
            'name' => 'Standard',
            'api_name' => 'standard',
            'default_scs_to_win' => 18,
            'total_scs' => 34
        ]);

        $powers = [
            ['name' => 'Deutschland', 'api_name' => 'GERMANY', 'color' => '#A28A75'],
            ['name' => 'England', 'api_name' => 'ENGLAND', 'color' => '#B400D1'],
            ['name' => 'Russland', 'api_name' => 'RUSSIA', 'color' => '#76798F'],
            ['name' => 'Italien', 'api_name' => 'ITALY', 'color' => '#0D1117'],
            ['name' => 'Frankreich', 'api_name' => 'FRANCE', 'color' => '#6338DF'],
            ['name' => 'Türkei', 'api_name' => 'TURKEY', 'color' => '#BFDFE9'],
            ['name' => 'Österreich', 'api_name' => 'AUSTRIA', 'color' => '#FBEDD7'],
        ];

        $variant->basePowers()->createMany($powers);
    }
}
