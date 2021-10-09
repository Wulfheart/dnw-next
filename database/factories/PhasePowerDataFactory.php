<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Phase;
use App\Models\PhasePowerData;
use App\Models\Power;

class PhasePowerDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhasePowerData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phase_id' => Phase::factory(),
            'power_id' => Power::factory(),
            'home_center_count' => $this->faker->randomNumber(),
            'supply_center_count' => $this->faker->randomNumber(),
            'unit_count' => $this->faker->randomNumber(),
            'orders_needed' => $this->faker->boolean,
            'orders' => $this->faker->text,
            'applied_orders' => $this->faker->text,
        ];
    }
}
