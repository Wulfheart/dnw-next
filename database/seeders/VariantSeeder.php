<?php

namespace Database\Seeders;

use App\Models\Variant;
use Illuminate\Database\Seeder;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variant = Variant::create([
            'name' => 'Standard',
            'api_name' => 'standard',
            'default_scs_to_win' => 18,
            'total_scs' => 34,
        ]);

        $powers = [
            ['name' => 'Deutschland', 'api_name' => 'GERMANY', 'color' => 'dimgray'],
            ['name' => 'England', 'api_name' => 'ENGLAND', 'color' => 'darkviolet'],
            ['name' => 'Russland', 'api_name' => 'RUSSIA', 'color' => '#757d91'],
            ['name' => 'Italien', 'api_name' => 'ITALY', 'color' => 'forestgreen'],
            ['name' => 'Frankreich', 'api_name' => 'FRANCE', 'color' => 'royalblue'],
            ['name' => 'Türkei', 'api_name' => 'TURKEY', 'color' => '#b9a61c'],
            ['name' => 'Österreich', 'api_name' => 'AUSTRIA', 'color' => 'red'],
        ];

        $variant->basePowers()->createMany($powers);
    }
}
