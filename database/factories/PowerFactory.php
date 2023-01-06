<?php

namespace Database\Factories;

use App\Models\BasePower;
use App\Models\Power;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PowerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Power::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'base_power_id' => BasePower::factory(),
            'user_id' => User::factory(),
            'is_defeated' => $this->faker->boolean,
            'is_winner' => $this->faker->boolean,
        ];
    }
}
