<?php

namespace Database\Factories;

use App\Models\BasePower;
use App\Models\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasePowerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BasePower::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'color' => $this->faker->word,
            'name' => $this->faker->name,
            'api_name' => $this->faker->word,
            'variant_id' => Variant::factory(),
        ];
    }
}
